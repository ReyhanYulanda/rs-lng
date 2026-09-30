<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="mb-4">
                        <h3 class="h5 mb-1">Jumlah Pasien per Tanggal Pendaftaran</h3>
                        <p class="text-muted mb-0">Pasien unik per tanggal, 7 hari terakhir</p>
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
        </div>
    </div>
</x-app-layout>
