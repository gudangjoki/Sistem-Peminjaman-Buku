<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peminjaman buku</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <span class="brand-text font-weight-light">Peminjaman buku</span>
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
                        @if (session()->get('user'))
                            <a href="/logout" class="btn btn-block btn-outline-secondary text-white px-5">Logout</a>
                        @else
                            <a href="/login" class="btn btn-block btn-outline-secondary text-white px-5">Login</a>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->
        <!-- Content Wrapper. Contains page content -->
        @switch($result)
        @case(in_array('home', $result) && in_array('dashboard', $result))
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                    <div class="row">
                        <div class="col-md-4">
                            <h1>Buku</h1>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group input-group-md mb-3">
                                <select class="category form-control btn btn-default px-4 dropdown-toggle" onchange="getParamsQuery()">
                                    <option selected disabled>Kategori</option>
                                    @foreach ( $categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
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
                        @foreach ($books as $book)
                        <div class="col-md-3">@include('component.card')</div>
                        @endforeach
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @break
        @case(in_array('books', $result) && in_array($book->book_code, $result))
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                    <div class="container">@include('user.detail_pinjam')</div>
                </div>
            </div>
        </div>
        @break
        @case(in_array('histori', $result) && in_array('dashboard', $result))
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                    <div class="container">@include('user.list_pinjam')</div>
                </div>
            </div>
        </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const rentButton = document.querySelector('.rent-button');

            if (rentButton) {
                rentButton.addEventListener('click', function() {
                    const bookCode = rentButton.getAttribute('data-book_code');
                    const username = rentButton.getAttribute('data-username');

                    console.log(bookCode);

                    fetch('/rent_book', {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: new URLSearchParams({
                            'book_code': bookCode,
                            'username': username
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.redirect) {
                            window.location.href = data.url;
                        }
                        console.log(data.error);
                        if (data.error) {
                            alert(data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            }
        });



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