<table class="table table-striped projects">
    <thead>
        <tr>
            <th style="width: 1%">
                #
            </th>
            <th style="width: 40%">
                Buku
            </th>
            <th style="width: 20%" class="text-center">
                Kategori
            </th>
            <th style="width: 10%" class="text-center">
                Status
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($pinjam as $pjm)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                <a>
                    {{ $pjm->title }}
                </a>
                <br/>
                <small>
                    {{ $pjm->book_code }}
                </small>
            </td>
            <td class="project-state">
                {{ $pjm->category_name }}
            </td>
            <td class="project-state">
                @if ($pjm->status == 1)
                    <span class="badge badge-success">Tersedia</span>
                @else 
                    <span class="badge badge-warning">Dipinjam</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
