<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report WR Online</title>

    <style>
        html,
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table.bordered tr th,
        table.bordered tr td {
            border: 1px solid #555;
            font-size: 11px;
        }

    </style>
</head>

<body>
    <table style="width: 100%;">
        <tr>
            <th colspan="4">Report Work Request Online</th>
        </tr>
        <tr>
            <td>User login: {{ session()->get('name') }}</td>
        </tr>
    </table>

    <table class="bordered">
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

</body>

</html>
