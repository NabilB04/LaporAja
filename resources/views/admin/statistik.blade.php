@extends('layouts.admin.app')
@section('title', 'Statistik Pengaduan')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Statistik Pengaduan</h1>
        <p class="text-gray-600">Analisis dan visualisasi data pengaduan warga</p>
    </div>

    <!-- Kartu Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-[#3CAEA3] text-white rounded-lg shadow-sm p-6 text-center">
            <h3 class="text-lg font-medium mb-2">Total Pengaduan</h3>
            <p class="text-5xl font-bold">{{ $totalPengaduan }}</p>
        </div>

        <div class="bg-[#4682B4] text-white rounded-lg shadow-sm p-6 text-center">
            <h3 class="text-lg font-medium mb-2">Selesai</h3>
            <p class="text-5xl font-bold">{{ $statusCounts[3] ?? 0 }}</p>
        </div>

        <div class="bg-[#F6B352] text-white rounded-lg shadow-sm p-6 text-center">
            <h3 class="text-lg font-medium mb-2">Sedang Diproses</h3>
            <p class="text-5xl font-bold">{{ $statusCounts[2] ?? 0 }}</p>
        </div>

        <div class="bg-[#CCCCCC] text-gray-800 rounded-lg shadow-sm p-6 text-center">
            <h3 class="text-lg font-medium mb-2">Ditolak</h3>
            <p class="text-5xl font-bold">{{ $statusCounts[4] ?? 0 }}</p>
        </div>
    </div>

    <!-- Grafik -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Grafik Kategori -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengaduan per Kategori</h3>
            <div class="h-80">
                <canvas id="kategoriChart"></canvas>
            </div>
        </div>

        <!-- Grafik Status -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Pengaduan</h3>
            <div class="h-80">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Grafik Bulanan -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengaduan per Bulan</h3>
        <div class="h-80">
            <canvas id="bulanChart"></canvas>
        </div>
    </div>

    <!-- Tombol Export -->
    <div class="flex justify-end">
        <a href="{{ route('admin.export') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200">
            <i class="fas fa-file-export mr-2"></i>Export Data
        </a>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

<script>
Chart.register(ChartDataLabels);
document.addEventListener('DOMContentLoaded', function() {
    // Grafik Kategori
    const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
    new Chart(kategoriCtx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($kategoriData as $kategori)
                    '{{ $kategori->nama_kategori }}',
                @endforeach
            ],
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: [
                    @foreach($kategoriData as $kategori)
                        {{ $kategori->pengaduan_count }},
                    @endforeach
                ],
                backgroundColor: '#3CAEA3',
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: '#f0f0f0'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Grafik Status
    const statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($statusData as $status)
                        '{{ $status->nama_status }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($statusData as $status)
                            {{ $status->pengaduan_count }},
                        @endforeach
                    ],
                    backgroundColor: ['#4682B4', '#F6B352', '#3CAEA3', '#CCCCCC'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const label = context.label || '';
                                const value = context.raw;
                                const percentage = @json($statusData->pluck('percentage'))[context.dataIndex] || 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: function (value, context) {
                            const percentages = @json($statusData->pluck('percentage'));
                            return percentages[context.dataIndex] + '%';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }
    
    // Grafik Bulanan
    const bulanCtx = document.getElementById('bulanChart').getContext('2d');
    new Chart(bulanCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($bulanLabels) !!},
            datasets: [
                {
                    label: 'Total',
                    data: {!! json_encode($bulanTotal) !!},
                    borderColor: '#3CAEA3',
                    backgroundColor: 'rgba(60, 174, 163, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Selesai',
                    data: {!! json_encode($bulanSelesai) !!},
                    borderColor: '#CCCCCC',
                    backgroundColor: 'rgba(204, 204, 204, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: '#f0f0f0'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>
@endsection
