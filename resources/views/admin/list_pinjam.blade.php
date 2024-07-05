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
        @php
            $groupedBooks = $pinjam->groupBy('book_code');
        @endphp

        @foreach($groupedBooks as $book_code => $books)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                <a>
                    {{ $books->first()->title }}
                </a>
                <br/>
                <small>
                    {{ $book_code }}
                </small>
            </td>
            <td class="project-state">
                {{ $books->pluck('category_name')->unique()->implode(', ') }}
            </td>
            <td class="project-state">
                @if ($books->pluck('status')->contains(1))
                    <span class="badge badge-success">Tersedia</span>
                @else 
                    <span class="badge badge-warning">Dipinjam</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
