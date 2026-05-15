<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Buku</title>
    <style>
        /* Pengaturan Dasar */
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        /* Styling Judul */
        h1 {
            text-align: center;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }

        /* Styling Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            /* Menyatukan border agar rapi */
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px 8px;
            font-size: 14px;
        }

        /* Header Tabel */
        th {
            background-color: #3498db;
            color: white;
            text-align: left;
            text-transform: uppercase;
        }

        /* Styling spesifik untuk kolom yang butuh rata tengah */
        th.text-center,
        td.text-center {
            text-align: center;
        }

        /* Efek Zebra (Warna selang-seling tiap baris) */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Styling Gambar */
        img {
            max-width: 60px;
            /* Membatasi ukuran gambar agar tabel tidak melebar */
            height: auto;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1>DATA BUKU</h1>
    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th class="text-center">Tahun</th>
                <th>Penerbit</th>
                <th>Kota</th>
                <th class="text-center">Image</th>
                <th class="text-center">Kuantitas</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach($books as $book)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td class="text-center">{{ $book->year }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->city }}</td>
                <td class="text-center">
                    <img src="{{ public_path('storage/cover_buku/'.$book->cover) }}" alt="Buku Tidak Ada">
                </td>
                <td class="text-center">{{ $book->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>