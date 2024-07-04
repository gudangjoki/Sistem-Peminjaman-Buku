<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peminjmanan Buku</title>
    <link rel="icon" href="{{ asset('book-solid.svg') }}" type="image/icon type">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
</head>
    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-closed sidebar-collapse sidebar-mini">
        <div class="wrapper">
            @include('layout.header')
            <!-- Main Sidebar Container -->
            @include('layout.sidebar')
            <!-- Content Wrapper. Contains page content -->
            @switch($result)
                @case(in_array('log', $result))
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                <h1>Log Peminjman</h1>
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                @include('admin/log_pinjam')
                            </div>
                            <!--/. container-fluid -->
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                    @break
                @case(in_array('buku', $result)  )
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                <h1>List Buku</h1>
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                @include('admin/list_book')     
                            </div>
                            <!--/. container-fluid -->
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                    @break
                @case(in_array('denda', $result)  )
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                <h1>List Denda</h1>
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                @include('admin/list_denda')
                            </div>
                            <!--/. container-fluid -->
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                    @break
                @case(in_array('pinjam', $result)  )
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                <h1>List Peminjman</h1>
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                @include('admin/list_pinjam')
                            </div>
                            <!--/. container-fluid -->
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                    @break
                @case(in_array('user', $result)  )
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                <h1>List Users</h1>
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                @include('admin/list_user')
                            </div>
                            <!--/. container-fluid -->
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                    @break
                @case(in_array('kategori', $result)  )
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                <h1>List Kategori</h1>
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                @include('admin/list_kategori')
                            </div>
                            <!--/. container-fluid -->
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                    @break
                @case(in_array('req', $result)  )
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                <h1>Permintaan Users</h1>
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                @include('admin/list_user_request')
                            </div>
                            <!--/. container-fluid -->
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                    @break
                @case(in_array('confirm', $result)  )
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                <h1>Konfirmasi Peminjaman</h1>
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                @include('admin/list_konfirmasi')
                            </div>
                            <!--/. container-fluid -->
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                    @break
                @default
                    <div>Section not found.</div>
                    @break
            @endswitch 

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            @include('layout.footer')

        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>

        <!-- jQuery Mapael -->
        <script src="{{ asset('lte/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
        <script src="{{ asset('lte/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('lte/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
        <script src="{{ asset('lte/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
        <script>
            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2()
            });
        </script>
    </body>

</html>
