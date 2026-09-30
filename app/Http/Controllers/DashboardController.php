<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function index()
    {
        $chartDates = collect(range(6, 0))
            ->map(fn ($daysAgo) => now()->startOfDay()->subDays($daysAgo));

        $patientsByDate = Pendaftaran::query()
            ->where('created_at', '>=', $chartDates->first())
            ->selectRaw('DATE(created_at) as tanggal, COUNT(DISTINCT id_pasien) as jumlah_pasien')
            ->groupByRaw('DATE(created_at)')
            ->pluck('jumlah_pasien', 'tanggal');

        $chartLabels = $chartDates->map(fn ($date) => $date->format('d-m'))->all();
        $chartValues = $chartDates
            ->map(fn ($date) => (int) $patientsByDate->get($date->toDateString(), 0))
            ->all();

        return view('dashboard', compact('chartLabels', 'chartValues'));
    }
}