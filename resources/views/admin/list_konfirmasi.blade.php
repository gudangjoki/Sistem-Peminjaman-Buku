<table class="table table-striped projects">
    <thead>
        <tr>
            <th style="width: 1%">
                #
            </th>
            <th style="width: 20%">
                Penyewa
            </th>
            <th style="width: 30%">
                Kode Buku
            </th>
            <th style="width: 30%">
                Judul Buku
            </th>
            <th style="width: 8%" class="text-center">
                Status
            </th>
            <th style="width: 20%">
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($confirm as $conf)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$conf->username}}
            </td>
            <td>
                {{$conf->book_code}}
            </td>
            <td>
                {{$conf->title}}
            </td>
            <td class="project-state">
                @if ($conf->status == 1)
                    <span class="badge badge-success">Tersedia</span>
                @else 
                    <span class="badge badge-warning">Dipinjam</span>
                @endif
            </td>
            <td class="project-actions text-right">
                <a class="btn btn-warning btn-sm" href="#">
                    <i class="fas fa-trash">
                    </i>
                    Konfirmasi
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>