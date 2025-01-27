<table class="table table-striped projects">
    <thead>
        <tr>
            <th style="width: 1%">#</th>
            <th style="width: 20%">Penyewa</th>
            <th style="width: 30%">No Telp</th>
            <th style="width: 8%" class="text-center">Status</th>
            <th style="width: 20%"></th>
        </tr>
    </thead>
    <tbody>

        @foreach ($users as $i => $user)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->phone }}</td>

            <td class="project-state">
                <span name="{{ $user->username }}" class="status-denda badge"></span>
            </td>
            <!-- <td class="project-state">
                <span class="status-denda badge badge-success">Clear</span>
            </td> -->
            <td class="project-actions text-right">
                
                <button onclick="showModal('{{ $user->username }}')" type="button" class="btn btn-primary btn-sm">
                    <i class="fas fa-folder"></i> View
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@foreach ($users as $user)
<div class="modal fade" id="modal-default-{{ $user->username }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $user->username }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Loading...</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
