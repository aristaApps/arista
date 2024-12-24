@extends('layouts.app')
@section('title', 'Beranda')
@section('content')
<div class="container-fluid">
    <div class="nav-item">
        <i class="fas fa-fw fa-tachometer-alt"></i> / <span>Beranda</span></a>
    </div>
    <h1 class="display-6 mt-4">Hi, {{ Auth::user()->name }}!</h1>
    <p class="lead">"Selamat Datang di Aplikasi Sistem Terstruktur Arsip LLDIKTI WILAYAH IX"</p>

    <!-- Content Row (3 Cards) -->
    <div class="row">
        <!-- Total User Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Dokument</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">100</div>
                        </div>
                        <div class="col-auto rotate-n-15">
                            <i class="fas fa-archive fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Dokumen Arsip Card -->
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

        <!-- Tasks Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Makassar</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300""></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
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
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Row Baru untuk Fitur -->
<div class="row text-center mt-4">
    <!-- Tracking Arsip -->
    <div class="col-md-4 mb-4">
        <div class="card shadow h-100 py-3">
            <div class="card-body">
                <div class="icon mb-3">
                    <i class="fas fa-folder fa-3x text-primary"></i>
                </div>
                <h5 class="card-title font-weight-bold">TRACKING ARSIP</h5>
                <p class="card-text">
                    Fitur tracking arsip pada web penyimpanan arsip digital merupakan suatu fungsionalitas
                    yang memungkinkan pengguna untuk melacak dan memantau pergerakan serta aktivitas terkait
                    suatu arsip secara real-time.
                </p>
            </div>
        </div>
    </div>

    <!-- Kelola Arsip -->
    <div class="col-md-4 mb-4">
        <div class="card shadow h-100 py-3">
            <div class="card-body">
                <div class="icon mb-3">
                    <i class="fas fa-folder-open fa-3x text-success"></i>
                </div>
                <h5 class="card-title font-weight-bold">KELOLA ARSIP</h5>
                <p class="card-text">
                    Fitur Kelola Arsip adalah bagian penting dari sebuah platform penyimpanan arsip digital
                    yang memungkinkan pengguna untuk mengorganisir, mengakses, dan mengelola dokumen-dokumen
                    mereka secara efektif.
                </p>
            </div>
        </div>
    </div>

    <!-- Data Master -->
    <div class="col-md-4 mb-4">
        <div class="card shadow h-100 py-3">
            <div class="card-body">
                <div class="icon mb-3">
                    <i class="fas fa-database fa-3x text-info"></i>
                </div>
                <h5 class="card-title font-weight-bold">DATA MASTER</h5>
                <p class="card-text">
                    Data master adalah kumpulan informasi dasar dan penting yang menjadi acuan utama dalam sebuah sistem.
                    Data master berfungsi sebagai kamus atau daftar referensi yang mendefinisikan semua elemen kunci dalam
                    sistem tersebut.
                </p>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
