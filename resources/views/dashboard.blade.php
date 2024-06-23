<x-layout title="Dashboard">
    <h1>Dashboard</h1>

    <div class="row">
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div
                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                <i class="fa-solid fa-users fa-xl"></i>
                            </div>
                            <div class="d-sm-none">
                                <h2 class="h5">Total pegawai</h2>
                                <h3 class="fw-extrabold mb-1">{{ $totalPegawai }}</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h6 text-gray-400 mb-0">Total pegawai</h2>
                                <h3 class="fw-extrabold mb-2">{{ $totalPegawai }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div
                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                <i class="fa-solid fa-person fa-xl"></i>
                            </div>
                            <div class="d-sm-none">
                                <h2 class="h5">Pegawai Laki-laki</h2>
                                <h3 class="fw-extrabold mb-1">{{ $totalLakiLaki }}</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h6 text-gray-400 mb-0">Pegawai Laki-laki</h2>
                                <h3 class="fw-extrabold mb-2">{{ $totalLakiLaki }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div
                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                                <i class="fa-solid fa-person-dress fa-xl"></i>
                            </div>
                            <div class="d-sm-none">
                                <h2 class="h5">Pegawai Perempuan</h2>
                                <h3 class="fw-extrabold mb-1">{{ $totalPerempuan }}</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h6 text-gray-400 mb-0">Pegawai Perempuan</h2>
                                <h3 class="fw-extrabold mb-2">{{ $totalPerempuan }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-4">
            <div class="card shadow border-0">
                <div class="card-header">
                    <div class="fs-5 fw-normal mb-2">Pegawai Berdasarkan Jabatan</div>
                </div>
                <div class="card-body p-2">
                    <div class="chart-pegawai" style="height: 280px; overflow: auto"></div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            new Chartist.Line('.chart-pegawai', {
                labels: @json($totalByJabatan->keys()),
                series: [
                    @json($totalByJabatan->values())
                ]
            }, {
                low: 1,
                showArea: true,
                fullWidth: true,
                plugins: [
                    Chartist.plugins.tooltip()
                ],
                axisX: {
                    // On the x-axis start means top and end means bottom
                    position: 'end',
                    showGrid: true
                },
                options: {
                    height: '280px',
                },
                scaleMinSpace: 1000,
                axisY: {
                    // On the y-axis start means left and end means right
                    showGrid: false,
                    showLabel: true,
                }
            });
        </script>
    @endpush
</x-layout>
