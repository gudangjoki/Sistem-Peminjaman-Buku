<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Top Navigation</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
        <style>
            .text-muted.text-sm {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .card-body img {
                width: 100%;
                height: 200px; /* You can adjust the height as needed */
                object-fit: cover; /* Ensures the image covers the area without distorting */
            }
        </style>
    </head>
    <body class="hold-transition layout-top-nav dark-mode">
        <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
            <div class="container ">
                <a href="../../index3.html" class="navbar-brand">
                    <img src="{{ asset('lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a href="" class="btn btn-block btn-outline-secondary text-white px-5">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                    <div class="row">
                        <div class="col-md-4">
                            <h1>Buku</h1>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group input-group-md mb-3">
                                <div class="input-group-prepend mr-5">
                                    <button type="button" class="btn btn-default px-4 dropdown-toggle" data-toggle="dropdown">
                                        Kategori
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="#">Action</a></li>
                                        <li class="dropdown-item"><a href="#">Another action</a></li>
                                        <li class="dropdown-item"><a href="#">Something else here</a></li>
                                        <li class="dropdown-divider"></li>
                                        <li class="dropdown-item"><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
                                @include('component.search')
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid px-md-5 pt-md-5 ml-0 mt-0">
                    
                    <div class="row">
                        <div class="col-md-3">@include('component.card')</div>
                        <div class="col-md-3">@include('component.card')</div>
                        <div class="col-md-3">@include('component.card')</div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
            @include('layout.footer')
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="{{ asset('lte/plugins/jquery/jquery.min.js ') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js ') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('lte/dist/js/adminlte.min.js ') }}"></script>
        <script>
            $(document).ready(function() {
                $('.card').each(function() {
                    var $cardBody = $(this).find('.card-body');
                    var $p = $cardBody.find('p');
                    var $readMoreBtn = $cardBody.find('.read-more');

                    if ($p[0].scrollHeight > $p.outerHeight()) {
                        $readMoreBtn.show();
                    }

                    $readMoreBtn.on('click', function() {
                        if ($p.hasClass('expanded')) {
                            $p.removeClass('expanded').css({
                                '-webkit-line-clamp': '2',
                                'overflow': 'hidden',
                                'text-overflow': 'ellipsis'
                            });
                            $(this).text('Read More');
                        } else {
                            $p.addClass('expanded').css({
                                '-webkit-line-clamp': 'unset',
                                'overflow': 'visible',
                                'text-overflow': 'unset'
                            });
                            $(this).text('Read Less');
                        }
                    });
                });
            });
        </script>
    </body>
</html>
