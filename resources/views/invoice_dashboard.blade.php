<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peminjaman Buku | Top Navigation</title>

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
            height: 200px;
            /* You can adjust the height as needed */
            object-fit: cover;
            /* Ensures the image covers the area without distorting */
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
                    <span class="brand-text font-weight-light">Peminjaman Buku</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/dashboard/home" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/histori" class="nav-link">History</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <!-- <a href="" class="btn btn-block btn-outline-secondary text-white px-5">Login</a> -->
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid px-md-5 pt-md-5 ml-0 mt-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-info"></i> Note:</h5>
                                    Harap segera mendatangi perpustakaan kami untuk mengambil buku yang akan dipinjam, tujukan kode peminjaman kepada petugas untuk mendapatkan buku
                                </div>


                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                            <i class="fas fa-globe"></i> Peminjaman Buku
                                            <!-- <small class="float-right">Date: 2/10/2014</small> -->
                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info mb-4">
                                        <div class="col-sm-8 invoice-col">
                                            <address>
                                            <strong>{{ $user->username }}</strong><br>
                                            Alamat: {{ $user->address }}<br>
                                            Phone: {{ $user->phone }}<br>
                                            </address>
                                        </div>
                                        <!-- /.col -->  
                                        <div class="col-sm-4 invoice-col">
                                            <b>Invoice #{{$book->id}}</b><br>
                                            <br>
                                            <b>Tanggal Dipinjam:</b>{{$book->rent_date}}<br>
                                            <b>Tanggal Wajib Kembali:</b>{{$book->return_date}}<br>
                                            <b>Tanggal Buku Dikembalikan:</b>{{$book->actual_return_date}}<br>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Buku</th>
                                                        <th>Judul</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $book->book_code }}</td>
                                                        <td>{{ $title }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- this row will not appear when printing -->
                                    <div class="row no-print">
                                        <div class="col-12 text-right">
                                            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default mx-3"><i class="fas fa-print"></i> Print</a>
                                            <button type="button" class="btn btn-primary" style="margin-right: 5px;">
                                            <i class="fas fa-download"></i> Generate PDF
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.invoice -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
      
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
        function dynamicInput() {
            let data = document.querySelector(".search").value;
            console.log(data);

            let queryString = window.location.search; // get url parameters
            let params = new URLSearchParams(queryString); // create url search params object
            params.delete('search'); // delete city parameter if it exists, in case you change the dropdown more then once
            params.append('search', document.querySelector(".search").value); // add selected city
            document.location.href = "?" + params.toString(); // refresh the page with new url
        }

        function getParamsQuery() {
            let queryString = window.location.search; // get url parameters
            let params = new URLSearchParams(queryString); // create url search params object
            params.delete('category'); // delete city parameter if it exists, in case you change the dropdown more then once
            params.append('category', document.querySelector(".category").value); // add selected city
            document.location.href = "?" + params.toString(); // refresh the page with new url

            window.history.pushState({}, '', '?' + params.toString());

            fetch('/books?' + params.toString())
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Handle the response data
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

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