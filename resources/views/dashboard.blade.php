<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('dashboard') }}" class="d-flex justify-content-end align-items-end gap-2 mb-4">
                <div>
                    <label for="periode" class="form-label mb-1">Periode Grafik</label>
                    <select name="periode" id="periode" class="form-select">
                        @foreach($periods as $value => $option)
                            <option value="{{ $value }}" @selected($period === $value)>{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Terapkan</button>
            </form>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="mb-4">
                        <h3 class="h5 mb-1">Jumlah Pasien per Tanggal Pendaftaran</h3>
                        <p class="text-muted mb-0">Pasien unik · {{ $periodDescription }}</p>
                    </div>
                    <div style="height: 340px;">
                        <canvas
                            id="pendaftaran-patient-chart"
                            data-labels="{{ json_encode($chartLabels) }}"
                            data-values="{{ json_encode($chartValues) }}"
                            aria-label="Grafik batang jumlah pasien unik per tanggal pendaftaran"
                            role="img"
                        ></canvas>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-1">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <h3 class="h5 mb-1">Pendaftaran per Status</h3>
                                <p class="text-muted mb-0">Jumlah pendaftaran · {{ $periods[$period]['label'] }}</p>
                            </div>
                            <div style="height: 320px;">
                                <canvas
                                    id="pendaftaran-status-chart"
                                    data-labels="{{ json_encode($statusChartLabels) }}"
                                    data-values="{{ json_encode($statusChartValues) }}"
                                    aria-label="Grafik batang horizontal jumlah pendaftaran per status"
                                    role="img"
                                ></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <h3 class="h5 mb-1">Pasien per Dokter</h3>
                                <p class="text-muted mb-0">Pasien unik · {{ $periods[$period]['label'] }}</p>
                            </div>
                            <div style="height: 320px;">
                                <canvas
                                    id="doctor-patient-chart"
                                    data-labels="{{ json_encode($doctorChartLabels) }}"
                                    data-values="{{ json_encode($doctorChartValues) }}"
                                    aria-label="Grafik pie jumlah pasien unik per dokter"
                                    role="img"
                                ></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
