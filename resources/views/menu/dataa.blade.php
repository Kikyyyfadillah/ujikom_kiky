@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu Terpopuler</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Jumlah Dipesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menuTerpopuler as $index => $menu)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $menu->nama }}</td>
                                <td>{{ $menu->jumlah_dipesan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection