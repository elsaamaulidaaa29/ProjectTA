<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Laporan Penjualan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah Terjual</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->barang->name ?? 'Tidak Ada' }}</td>
                    <td>{{ $p->jumlah_terjual }}</td>
                    <td>{{ $p->date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
