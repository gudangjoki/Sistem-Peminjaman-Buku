<table class="table table-striped projects">
    <thead>
        <tr>
            <th style="width: 1%">
                #
            </th>
            <th style="width: 20%">
                Nama Kategori
            </th>
            <th style="width: 20%">
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$category->name}}
            </td>
            <td class="project-actions text-right">
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default{{$category->id}}">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                </button>
                <!-- <a class="btn btn-danger btn-sm" href="#">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </a> -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- modal -->
<div class="modal fade" id="modal-default">
    <form action="{{ route('add.category') }}" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="category" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
</div>
<!-- /.modal -->

@foreach ($categories as $category)
<div class="modal fade" id="modal-default{{$category->id}}">
    <form action="{{ route('edit.category', ['category_id' => $category->id]) }}" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kategori {{$category->name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="category" class="form-control" value="{{$category->name}}" placeholder="Enter ...">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endforeach