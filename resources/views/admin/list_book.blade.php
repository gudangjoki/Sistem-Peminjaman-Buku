<div class="row mt-3 pt-3">
    @foreach($books as $book)
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
            <div class="card bg-light d-flex flex-fill card-outline card-dark shadow">
                <div class="card-header text-muted border-bottom-0">
                    {{$book->book_code}}
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b>{{$book->title}}</b></h2>
                            <p class="text-muted text-sm"><b>{{$book->description}}</b></p>
                            <!-- <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                            </ul> -->
                        </div>
                        <div class="col-5 text-center">
                            <img src="{{ asset($book->cover) }}" alt="book-cover" class="img-fluid fixed-size-img">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="buku/edit-buku/{{ $book->book_code }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                        <!-- <a class="btn btn-danger btn-sm" href="#">
                            <i class="fas fa-trash"></i> Delete
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

