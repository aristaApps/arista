@extends('layouts.app')
@section('title', 'Beranda')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="nav-item">
        <i class="fas fa-fw fa-tachometer-alt"></i> / <span>Beranda</span>
    </div>

    <!-- Greeting -->
    <h1 class="display-6 mt-4">Hi, {{ Auth::user()->name }}!</h1>
    <p class="lead">"Selamat Datang di Aplikasi Sistem Terstruktur Arsip LLDIKTI WILAYAH IX"</p>

    <!-- Cards Row -->
    <div class="row">
        <!-- Total Documents -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Documents</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pdfCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-archive fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit Pengelola -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Unit Pengelola</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Date -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Makassar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Distribusi Dokumen</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="documentPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2"><i class="fas fa-circle text-primary"></i> HKT</span>
                        <span class="mr-2"><i class="fas fa-circle text-success"></i> Keuangan</span>
                        <span class="mr-2"><i class="fas fa-circle text-info"></i> Kelembagaan</span>
                        <span class="mr-2"><i class="fas fa-circle text-warning"></i> Kemahasiswaan</span>
                        <span class="mr-2"><i class="fas fa-circle text-danger"></i> Akademik</span>
                        <span class="mr-2"><i class="fas fa-circle text-secondary"></i> SDPT</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row text-center mt-4">
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100 py-3">
                <div class="card-body">
                    <i class="fas fa-folder fa-3x text-primary mb-3"></i>
                    <h5 class="card-title font-weight-bold">TRACKING ARSIP</h5>
                    <p class="card-text">Fitur tracking arsip memungkinkan pengguna melacak dan memantau aktivitas arsip secara real-time.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100 py-3">
                <div class="card-body">
                    <i class="fas fa-folder-open fa-3x text-success mb-3"></i>
                    <h5 class="card-title font-weight-bold">KELOLA ARSIP</h5>
                    <p class="card-text">Fitur untuk mengelola dokumen secara efektif melalui platform digital.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100 py-3">
                <div class="card-body">
                    <i class="fas fa-database fa-3x text-info mb-3"></i>
                    <h5 class="card-title font-weight-bold">DATA MASTER</h5>
                    <p class="card-text">Data master berisi informasi dasar sebagai acuan utama dalam sistem.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('documentPieChart').getContext('2d');
        const documentCounts = @json($documentCounts, JSON_THROW_ON_ERROR);

        const colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'];

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: Object.keys(documentCounts),
                datasets: [{
                    data: Object.values(documentCounts),
                    backgroundColor: colors,
                    hoverBackgroundColor: colors,
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: 'rgb(255,255,255)',
                    bodyFontColor: '#858796',
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                }
            }
        });
    });
</script>
@endsection
