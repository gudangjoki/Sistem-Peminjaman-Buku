<aside class="main-sidebar sidebar-dark-primary elevation-4 nav nav-compact">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Libgen</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('lte/dist/img/user1-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            List
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="log" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Log Peminjaman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="buku" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="denda" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Denda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pinjam" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Pinjam</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="kategori" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Kategori</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="req" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Active Request 
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="confirm" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Konfirmasi
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>