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
            <th style="width: 15%">
                Action 
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
                    Aktif
                @else
                    Ban
                @endif
            </td>
            <td class="project-actions text-right">
            @if ($user->status == 0)
            <form action="/verify/{{ $user->username }}" method="POST">
            @csrf
            @method("PUT")
                <button type="submit" class="btn btn-warning btn-sm">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Unbanned
                </button>
            </form>
            @else
            <form action="/ban/{{ $user->username }}" method="POST">
            @csrf
            @method("PUT")
                <button type="submit" class="btn btn-warning btn-sm">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Ban
                </button>
            </form>
            @endif
            </td>
        </tr>

        @endforeach
    </tbody>
</table>