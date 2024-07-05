<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Tambah Buku</h3>

    </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="http://127.0.0.1:8000/buku" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <!-- <div class="form-group">
                            <label>Kode Buku</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                        </div> -->
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kategori</label>
                                <select name="category" class="category form-control btn btn-default px-4 dropdown-toggle" onchange="getParamsQuery()">
                                    <option selected disabled>Kategori</option>
                                    @foreach ( $categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                <input type="file" name="cover" class="custom-file-input" id="exampleInputFile">
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
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <button type="submit" class="col text-right">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
</div>