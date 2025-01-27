<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Edit Buku</h3>

    </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ url('books/update/' . $book->book_code) }}" method="POST" enctype="multipart/form-data">
            @csrf  
            @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Kode Buku</label>
                            <input type="text" name="book_code" class="form-control" value="{{ $book -> book_code }}" placeholder="Enter ..." disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="title" value="{{ $book->title }}" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kategori</label>
                            <div class="select select2-dark">
                                <select name="category[]" multiple="multiple" data-placeholder="Select a State" class="select2 category form-control" style="width: 100%;">
                                    @foreach ( $categories as $category )
                                    <option value="{{ $category->id }}" 
                                        @if (in_array($category->id, $selectedCategories)) 
                                            selected 
                                        @endif>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="cover" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile"> {{ $book->cover }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ $book->description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
</div>