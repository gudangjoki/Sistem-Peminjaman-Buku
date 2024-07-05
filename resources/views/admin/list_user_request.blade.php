<table class="table table-striped projects">
    <thead>
        <tr>
            <th style="width: 1%">
                #
            </th>
            <th style="width: 20%">
                Username
            </th>
            <th style="width: 8%" class="text-center">
                Status
            </th>
            <th style="width: 20%">
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reqs as $req)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$req->username}}
            </td>
            <td class="project-state">
                <span class="badge badge-warning">Not Aktif</span>
            </td>
            <td class="project-actions text-right">
                <a class="btn btn-warning btn-sm" href="#">
                    <i class="fas fa-folder">
                    </i>
                    Konfirmasi
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>