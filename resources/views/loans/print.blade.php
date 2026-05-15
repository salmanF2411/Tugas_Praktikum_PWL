<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Peminjaman</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px 8px;
            font-size: 14px;
        }

        th {
            background-color: #3498db;
            color: white;
            text-align: left;
            text-transform: uppercase;
        }

        th.text-center,
        td.text-center {
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <h1>DATA PEMINJAMAN</h1>
    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>NPM</th>
                <th>Nama</th>
                <th class="text-center">Tanggal Pinjam</th>
                <th class="text-center">Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($loans as $loan)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $loan->user_npm }}</td>
                <td>{{ optional($loan->user)->first_name ? optional($loan->user)->first_name . ' ' . optional($loan->user)->last_name : '-' }}</td>
                <td class="text-center">{{ $loan->loan_at }}</td>
                <td class="text-center">{{ $loan->return_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>