<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #435ebe;
            color: white;
            text-align: center;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h1>Data Kategori</h1>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
        </tr>
        @php
        $no = 1;
        @endphp
        @foreach ($kategori as $p)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $p->nama_kategori}}</td>
            <!-- <td><img width="70" src="data:image/png;base64,{{ $p->imageData }}" alt="{{ $p->name }}"></td>
            <td>{{ $p->deskripsi }}</td> -->
        </tr>
        @endforeach
    </table>

</body>

</html>