<div class="container">
    <table class="table">
        <thead>
            <tr>
            <th style="width: 10%">#</th>
            <th>Judul</th>
            <th>Invoice</th>
            <th>Rentang Peminjman</th>
            <th>Status</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td><img alt="Avatar" class="table-avatar" src="{{ asset($log->cover) }}" style="width: 100%"></td>
                    <td>{{$log->title}}</td>
                    <td>{{$log->id}}</td>
                    <td>
                        @if ($log->return_date == null)
                            belum konfirmasi
                        @else
                            {{$log->return_date}}
                        @endif
                    </td>
                    <td>
                        @if ($log->rent_date == null)
                            <span class="badge badge-warning">Belum konfirmasi</span>
                        @elseif ($log->actual_return_date != null)
                            <span class="badge badge-success">Selesai</span>
                        @else
                            @php
                                $today = now();
                                $returnDate = \Carbon\Carbon::parse($log->return_date);
                            @endphp
                            @if ($returnDate->lessThan($today))
                                <span class="badge badge-danger">Terlambat</span>
                            @else
                                <span class="badge badge-info">Dipinjam</span>
                            @endif
                        @endif
                    </td>
                    <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                            <a href="../invoice/{{ $log->book_code }}/{{ $log->id }}" class="btn btn-info"><i class="fas fa-eye"></i> View</a>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
 </div>
