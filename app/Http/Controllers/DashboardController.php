<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $now = now();
        $periods = [
            '24_jam' => [
                'label' => '24 Jam',
                'start' => $now->copy()->subHours(24),
                'description' => 'Per jam, 24 jam terakhir',
                'granularity' => 'hour',
            ],
            '7_hari' => [
                'label' => '7 Hari',
                'start' => $now->copy()->subDays(6)->startOfDay(),
                'description' => 'Per tanggal, 7 hari terakhir',
                'granularity' => 'day',
            ],
            '1_bulan' => [
                'label' => '1 Bulan',
                'start' => $now->copy()->subMonthNoOverflow()->startOfDay(),
                'description' => 'Per tanggal, 1 bulan terakhir',
                'granularity' => 'day',
            ],
            '3_bulan' => [
                'label' => '3 Bulan',
                'start' => $now->copy()->subMonthsNoOverflow(3)->startOfDay(),
                'description' => 'Per tanggal, 3 bulan terakhir',
                'granularity' => 'day',
            ],
        ];

        $period = $request->query('periode', '7_hari');

        if (! array_key_exists($period, $periods)) {
            $period = '7_hari';
        }

        $periodStart = $periods[$period]['start'];
        $periodDescription = $periods[$period]['description'];

        if ($periods[$period]['granularity'] === 'hour') {
            $hourBuckets = collect(range(0, 23));
            $visitsByHour = Pendaftaran::query()
                ->whereBetween('created_at', [$periodStart, $now])
                ->get(['id_pasien', 'created_at'])
                ->groupBy(fn ($pendaftaran) => intdiv(
                    $pendaftaran->created_at->getTimestamp() - $periodStart->getTimestamp(),
                    3600,
                ));

            $chartLabels = $hourBuckets
                ->map(fn ($hour) => $periodStart->copy()->addHours($hour)->format('H:i'))
                ->all();
            $chartValues = $hourBuckets
                ->map(fn ($hour) => $visitsByHour->get($hour, collect())->pluck('id_pasien')->unique()->count())
                ->all();
        } else {
            $chartDates = collect();
            $date = $periodStart->copy()->startOfDay();

            while ($date->lte($now)) {
                $chartDates->push($date->copy());
                $date->addDay();
            }

            $patientsByDate = Pendaftaran::query()
                ->whereBetween('created_at', [$periodStart, $now])
                ->selectRaw('DATE(created_at) as tanggal, COUNT(DISTINCT id_pasien) as jumlah_pasien')
                ->groupByRaw('DATE(created_at)')
                ->pluck('jumlah_pasien', 'tanggal');

            $chartLabels = $chartDates->map(fn ($date) => $date->format('d-m'))->all();
            $chartValues = $chartDates
                ->map(fn ($date) => (int) $patientsByDate->get($date->toDateString(), 0))
                ->all();
        }

        $registrationsByStatus = Pendaftaran::query()
            ->whereBetween('created_at', [$periodStart, $now])
            ->select('status')
            ->selectRaw('COUNT(*) as jumlah')
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        $patientsByDoctor = Pendaftaran::query()
            ->whereBetween('created_at', [$periodStart, $now])
            ->select('id_dokter')
            ->selectRaw('COUNT(DISTINCT id_pasien) as jumlah_pasien')
            ->groupBy('id_dokter')
            ->orderBy('id_dokter')
            ->get();

        $doctors = Dokter::whereIn('id', $patientsByDoctor->pluck('id_dokter'))
            ->pluck('nama', 'id');

        $statusChartLabels = $registrationsByStatus->pluck('status')->all();
        $statusChartValues = $registrationsByStatus->map(fn ($item) => (int) $item->jumlah)->all();
        $doctorChartLabels = $patientsByDoctor
            ->map(fn ($item) => $doctors->get($item->id_dokter, 'Dokter ID ' . $item->id_dokter))
            ->all();
        $doctorChartValues = $patientsByDoctor->map(fn ($item) => (int) $item->jumlah_pasien)->all();

        return view('dashboard', compact(
            'chartLabels',
            'chartValues',
            'statusChartLabels',
            'statusChartValues',
            'doctorChartLabels',
            'doctorChartValues',
            'period',
            'periods',
            'periodDescription',
        ));
    }
}