<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Edit Category</h3>

    </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Kode Buku</label>
                            <input type="text" class="form-control" value="{{ $book -> book_code }}" placeholder="Enter ..." disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" value="{{ $book->title }}" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control select2">
                            <option selected="selected" disabled>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                <!-- <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option> -->
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                <input type="file" value="{{ $book->cover }}" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
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
                            <textarea class="form-control" rows="3" placeholder="Enter ...">{{ $book->description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <div class="col text-right"> <a href="" class="btn btn-primary px-4">Submit</a></div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
</div>