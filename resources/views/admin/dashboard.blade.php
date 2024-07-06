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
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <style>
        .fixed-size-img {
            width: 100%; /* atau set ukuran spesifik seperti width: 150px; height: 200px; */
            height: auto; /* Sesuaikan ukuran sesuai aspek rasio gambar */
            object-fit: cover; /* Menghindari gambar terdistorsi */
        }
    </style>
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
                @case(in_array('buku', $result) && !in_array('tambah-buku', $result) && !in_array('edit-buku', $result) )
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                <div class="row">
                                    <div class="col-md-2"><h1>List Buku</h1></div>
                                    <div class="col-md-8">
                                        <div class="input-group input-group-md mb-3">
                                            <div class="input-group-prepend mr-5">
                                            <select class="category form-control btn btn-default px-4 dropdown-toggle" onchange="getParamsQuery()">
                                                <option selected disabled>Kategori</option>
                                                @foreach ( $categories as $category )
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                                <!-- <button type="button" class="btn btn-default px-4 dropdown-toggle" data-toggle="dropdown">
                                                    Kategori
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item"><a href="#">Action</a></li>
                                                    <li class="dropdown-item"><a href="#">Another action</a></li>
                                                    <li class="dropdown-item"><a href="#">Something else here</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li class="dropdown-item"><a href="#">Separated link</a></li>
                                                </ul> -->
                                            </div>
                                            <!-- /btn-group -->
                                            @include('component.search')
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <div class="col-md-2">
                                        <a href="buku/tambah-buku" class="btn btn-md btn-success float-right px-4">
                                            <i class="fas fa-edit"></i> Tambah
                                        </a>
                                    </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                            <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                                <div class="row mt-3 pt-3">
                                    @include('admin.list_book')     
                                </div>
                            </div>

                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @break
        @case(in_array('denda', $result) )
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
        @case(in_array('pinjam', $result) )
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
        @case(in_array('user', $result) )
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
        @case(in_array('kategori', $result) )
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                    <div class="row">
                        <div class="col-md-8">
                            <h1>List Kategori</h1>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success float-right px-3" data-toggle="modal" data-target="#modal-default">
                                Tambah
                            </button>
                        </div>
                    </div>
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
        @case(in_array('req', $result) )
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
        @case(in_array('confirm', $result) )
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

        @case(in_array('tambah-buku', $result))
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                    <h1>Tambah Buku</h1>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                    @include('admin/create_book')
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        @break

        @case(in_array('edit-buku', $result) && in_array('buku', $result))
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                    <h1>Edit Buku</h1>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid px-md-5 mt-md-5 ml-0 mt-0">
                    @include('admin/edit_book')
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
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
    <!-- bs-custom-file-input -->
    <script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js ') }}"></script>
    <!-- jQuery Mapael -->
    <script src="{{ asset('lte/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('lte/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script>

function status() {
        let url = `/dashboard/denda/status/all`;
        console.log(url);
        fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data['wawan']);
                let statusElements = document.querySelectorAll(".status-denda");
                statusElements.forEach(element => {
                    let name = element.getAttribute('name');
                    // console.log(name);
                    if (data[name] !== undefined) {
                        if (data[name] > 0) {
                            console.log(element);
                            element.classList.add('badge-warning');
                            element.textContent = "Perlu Bayar Denda";
                        } else {
                            element.classList.add('badge-success');
                            element.textContent = "Belum Denda";
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }

        document.addEventListener('DOMContentLoaded', (event) => {
            status();
        });

        function showModal(username) {
            let url = `/dashboard/denda/all`;
            console.log(url);
            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                    let modal = $('#modal-default-' + username);
                    let modalBody = modal.find('.modal-body');
                    modalBody.empty();
                        // if (data.message.indexOf(username) === -1) {
                        //     document.querySelector(".status-denda").value = "Sudah Bayar"
                        // }
                    if (data.message[username]) {
                        let values = data.message[username];
                        localStorage.setItem(username, JSON.stringify(values));
                        values.forEach(function(value) {
                            console.log(value);
    
                            value.map(function(val) {
                                modalBody.append('<div classname="border-3">');
                                modalBody.append('<p><strong>Title:</strong> ' + val.title + '</p>');
                                modalBody.append('<p><strong>Book Code:</strong> ' + val.book_code + '</p>');
                                // modalBody.append('<p><strong>Description:</strong> ' + val.description + '</p>');
                                // modalBody.append('<img src="' + val.cover + '" alt="Book Cover" style="width:100px;height:auto;">');
                                modalBody.append('<hr>');
                                modalBody.append('<hr>');
                                modalBody.append('<div>');
                            })
                        });
                    } else {
                        modalBody.append('<p>No data available</p>');
                    }

                    modal.modal('show');
                })
                .catch(error => console.error('Error fetching data:', error));
        }

            function confirmation(e, username) {
            let data = localStorage.getItem(username);
            const { name, value } = e.target;
            fetch(`/update/denda/${username}`, {
                method: "PUT",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ data })
            })
            .then(res => res.json())
            .then(data => console.log(data))
            .catch(error => console.error('Error fetching data:', error));
        }

        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();
            
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
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>