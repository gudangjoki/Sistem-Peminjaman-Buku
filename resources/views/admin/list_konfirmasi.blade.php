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
        <form action="/pinjam/{{ $conf->book_code }}/user/{{ $conf->username }}" method="POST">
            @csrf
            @method("PUT")
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
                <button type="submit" class="btn btn-warning btn-sm">
                    <i class="fas fa-trash">
                    </i>
                    Konfirmasi
                </button>
            </td>
        </tr>
        </form>
        @endforeach
    </tbody>
</table>