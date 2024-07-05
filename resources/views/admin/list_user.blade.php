<table class="table table-striped projects">
    <thead>
        <tr>
            <th style="width: 1%">
                #
            </th>
            <th style="width: 20%">
                Username
            </th>
            <th style="width: 30%">
                Nomor Telp
            </th>
            <th style="width: 15%">
                Alamat
            </th>
            <th style="width: 15%">
                Status 
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td>
                {{ $user->username }}
            </td>
            <td>
                {{ $user->phone }}
            </td>
            <td>
                {{ $user->address }}
            </td>
            <td>
                @if ($user->status == 1)
                    <p>Aktif</p>
                @else
                    <p>Non-Aktif</p>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>