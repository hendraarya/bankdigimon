<table>
    <tr>
        <th colspan="4">Report WR Online</th>
    </tr>
</table>

<table>
    <thead>
        <tr>
        <th align="center">No</th>
                <th align="center">WR ID</th>
                <th align="center">Machine No</th>
                <th align="center">Machine Name</th>
                <th align="center">Failure Date</th>
                <th align="center">Failure Time </th>
                <th align="center">Problem </th>
                <th align="center">Type</th>
                <th align="center">Urgency </th>
                <th align="center">Priority </th>

        </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $row->swr }}</td>
                <td>{{ $row->smach }}</td>
                <td>{{ $row->smachname}}</td>
                <td>{{ $row->drepair }}</td>
                <td>{{ $row->trepair}}</td>
                <td>{{ $row->sproblem }}</td>
                <td>{{ $row->stype }}</td>
                <td>{{ $row->surgency }}</td>
                <td>{{ $row->spriority }}</td>
            </tr>
            @endforeach
    </tbody>
</table>