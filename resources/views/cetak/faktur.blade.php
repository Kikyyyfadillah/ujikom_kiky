<body>
    <h2>Cafe Indomart</h2>
    <h5>Jl. Mockingjay No. 45, 3423</h5>
    <hr>
    @if (isset($transaksi))
    <h5>No. Faktur : {{ $transaksi->id }}</h5>
    <h5>{{ $transaksi->tanggal }}</h5>
   

    <table border="0">
        <thead>
            <tr>
                <td>Qty</td>
                <td>Item</td>
                <td>Harga</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->DetailTransaksi as $item)
            <tr>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->menu->nama_menu }}</td>
                <td>{{ number_format($item->menu->harga,0, "," , ".") }}</td>
                <td>{{ number_format($item->subtotal,0, "," , ".") }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td cosplan="3">Total</td>
                <td>{{ number_format($transaksi->total_harga ,0, "," , ".") }}</td>
            </tr>
        </tfoot>
    </table>
    @else
    <p>No transaction found.</p>
    @endif
</body>