<div class="card">
    <div class="card-header">
        <div class="card-tools">
            @if ($book->status == 1)
            <span class="badge badge-success px-4">{{ "Tersedia" }}</span>
            @else
            <span class="badge badge-danger px-4">{{ "Tidak Tersedia" }}</span>
            @endif
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <h2 class="lead"><b>{{ $book->title }}</b></h2>
        <p class="text-muted text-sm mb-0">{{ $book->description }}</p>
        <button class="btn btn-link p-0 read-more mb-3" style="display: none;">Read More</button>      
        <img src="{{ asset ('lte/dist/img/prod-1.jpg') }}" alt="" class=" img-fluid">
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-right">
        @if ($book->status == 1)
            <a href='../books/{{ $book->book_code }}' class="btn btn-info ">Ayo Pinjam</a>
        @else
            <a href="" class="btn btn-info disabled">Ayo Pinjam</a>
        @endif
        </div>   
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.card -->
