<table>
    <tr>
        <th colspan="4">Laporan Log Machine</th>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th align="center">No</th>
            <th align="center">Tanggal Planning</th>
            <th align="center">Rubber Name</th>
            <th align="center">Batch No</th>
            <th align="center">Start Mixing </th>
            <th align="center">Finish Mixing </th>
            <th align="center">Start Mixing System </th>
            <th align="center">Finish Mixing System </th>

        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $row->tgl_plan }}</td>
            <td>{{ $row->rubber_name }}</td>
            <td>{{ $row->batch_no }}</td>
            <td>{{ $row->start_mixing }}</td>
            <td>{{ $row->finish_mixing}}</td>
            <td>{{ $row->start_mixingsys }}</td>
            <td>{{ $row->finish_mixingsys }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
