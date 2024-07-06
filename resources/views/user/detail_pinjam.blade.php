<div class="container">
    <div class="row">

        <div class="col-12 col-sm-6">
            <h3 class="d-inline-block d-sm-none">{{ $book->title }}</h3>
            <div class="col-12">
                <img src="{{ asset($book->cover) }}" class="product-image" alt="Product Image">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <h3 class="my-3">{{ $book->title }}</h3>
            <div class="bg-gray py-2 px-3 my-4">
                <h4 class="mt-0">
                    <small>{{ $book->book_code }}</small>
                </h4>
            </div>
            <p>{{ $book->description }}</p>

            <div class="mt-4 text-right">
                <!-- <form action="../rent_book" method="POST" id="rentBookForm"> -->
                    <!-- @csrf -->
                     @if(!$user)
                     <button type="submit" class="rent-button btn btn-primary btn-lg"
                        data-book_code="{{ $book->book_code }}" disabled>
                            Login Dulu, Baru Bisa Pinjam
                    </button>
                     @else
                     <button type="submit" class="rent-button btn btn-primary btn-lg"
                        data-book_code="{{ $book->book_code }}" 
                        data-username="{{ $user['username'] }}">
                            Pinjam Sekarang
                    </button>
                     @endif
                <!-- </form> -->
            </div>

        </div>
    </div>
</div>