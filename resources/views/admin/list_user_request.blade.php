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
                <!-- Action -->
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

            @if ($req->status === null)
            <td class="project-state">
                <span class="badge badge-warning">Not Active</span>
            </td>
            @endif

            @if ($req->status === null)
            <td class="project-actions text-right">
                <form action="/verify/{{$req->username}}" method="POST">
                    @csrf
                    @method("PUT")
                    <button class="btn btn-warning btn-sm" type="submit">
                        <i class="fas fa-folder"></i>
                            Konfirmasi
                    </button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
