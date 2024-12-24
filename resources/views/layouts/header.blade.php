<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-1">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - FAQ -->
        {{-- <li class="nav-item">
            <a class="nav-link" href="#" role="button">
                <i class="fas fa-question-circle fa-fw"></i>
                <span class="d-none d-lg-inline text-gray-600 small"></span>
            </a>
        </li> --}}

        <!-- Nav Item - Alerts (Notifications) -->
        {{-- <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Notifications</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 12, 2024</div>
                        <span class="font-weight-bold">New report is ready to download!</span>
                    </div>
                </a>
                <!-- Tambahkan notifikasi lainnya di sini -->
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li> --}}

        <!-- Nav Item - User Logout -->
        <li class="nav-item dropdown no-arrow">
            <form method="POST" action="{{ route('logout') }}" class="nav-link p-0">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i> Logout
                </button>
            </form>
        </li>

    </ul>
</nav>
