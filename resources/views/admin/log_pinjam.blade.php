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
                Kode Buku 
            </th>
            <th style="width: 15%">
                Berlaku
            </th>
            <th style="width: 15%">
                Sampai 
            </th>
            <th style="width: 15%">
                Tanggal Dikembali
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logs as $log)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$log->username}}
            </td>
            <td>
                {{$log->book_code}}
            </td>
            <td>
                @if(is_null($log->rent_date))
                    <span class="badge badge-danger">Belum Konfirmasi</span>
                @else
                    {{$log->rent_date}}
                @endif
            </td>
            <td>
                @if(is_null($log->return_date))
                    <span class="badge badge-warning">Belum Konfirmasi</span>
                @else
                    {{$log->return_date}}
                @endif
            </td>
            <td>
                @if(is_null($log->actual_return_date))
                    <span class="badge badge-danger">Belum Dikembalikan</span>
                @else
                    {{$log->actual_return_date}}
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>