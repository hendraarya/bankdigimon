<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Planning Rubber</title>

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
            <th colspan="4">Report Planning Rubber</th>
        </tr>
        <tr>
            <td>User login: {{ session()->get('name') }}</td>
        </tr>
    </table>

    <table class="bordered">
        <thead>
            <tr>
                <th align="center">No</th>
                <th align="center">Tanggal Plan</th>
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

</body>

</html>
