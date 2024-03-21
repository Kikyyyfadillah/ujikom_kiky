@extends('template/layout')

@push('style')
@endpush

@section('content')
<!-- page content -->
<div class="right_col" role="main">


    <!-- tabel -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="dashboard_graph">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3>produk</h3>
                    </div>
                    <div class="col-md-6">
                        <div id="reportrange" class="pull-right" style="
                                    background: #fff;
                                    cursor: pointer;
                                    padding: 5px 10px;
                                    border: 1px solid #ccc;
                                ">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span>December 30, 2014 - January 28, 2015</span>
                            <b class="caret"></b>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-3 bg-white">
                    <div class="x_title">
                        <h2>Kategori</h2>
                        <div class="float-right ml-auto">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormProduk">
                                Tambah produk
                            </button>
                            <a class="btn btn-success" href="{{route('export-produk')}}" class="btn btn-success><i class=" fa fa-file-excel-o"></i>Export</a>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#formImport">
                                <i class="fas fa-file-excel"></i> Import
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" \ aria-label="Close">
                            </button>
                        </div>
                        @endif
                        <div class="mt-3">
                            @include('produk.data')
                        </div>
                        <!-- /table -->
                        <!-- Button trigger modal -->
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <br />
</div>
@include('produk.form')
</section>

</div>
<!-- /page content -->
@endsection

@push('script')
<script>
    $('#harga_beli').on('input', function() {
        var hargaBeli = parseFloat($(this).val()); // Mendapatkan nilai harga beli dari input
        if (!isNaN(hargaBeli)) { // Memastikan harga beli adalah angka
            var keuntungan = hargaBeli * 0.7; // Menghitung keuntungan 70%
            var hargaJual = Math.ceil((hargaBeli + keuntungan) / 500) * 500; // Pembulatan ke atas ke kelipatan 500
            $('#harga_jual').val(hargaJual); // Menetapkan nilai harga jual ke input harga jual
        }
    });
    // $('#tbl-jenis').DataTable()
//js
    $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-success').slideUp(500)
    });
    $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-danger').slideUp(500)
    });

    // console.log($('.delete-data'))

    $('.btn-delete').on('click', function(e) {
        let data = $(this).closest('tr').find('td:eq(1)').text();
        console.log('delete')
        Swal.fire({
            icon: 'error',
            title: 'Hapus Data',
            html: `Apakah data <b>${data}</b> akan dihapus?`,
            confirmButtonText: 'Ya',
            denyButtonText: 'Tidak',
            showDenyButton: 'true',
            focusConfirm: false
        }).then((result) => {
            if (result.isConfirmed) $(e.target).closest('form').submit()
            else swal.close()
        })
    });

    $('#modalFormProduk').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget)
        const mode = btn.data('mode')
        const nama_produk = btn.data('nama_produk')
        const nama_supplier = btn.data('nama_supplier')
        const harga_beli = btn.data('harga_beli')
        const harga_jual = btn.data('harga_jual')
        const stok = btn.data('stok')
        const keterangan = btn.data('keterangan')
        const id = btn.data('id')
        const modal = $(this)
        console.log(btn)
        if (mode === 'edit') {
            modal.find('.modal-title').text('Edit Data')
            modal.find('#nama_produk').val(nama_produk)
            modal.find('#nama_supplier').val(nama_supplier)
            modal.find('#harga_beli').val(harga_beli)
            modal.find('#harga_jual').val(harga_jual)
            modal.find('#stok').val(stok)
            modal.find('#keterangan').val(keterangan)
            modal.find('.modal-body form').attr('action', '{{ url("produk")}}/' + id)
            modal.find('#method').html('@method("PATCH")')
        } else {
            modal.find('.modal-title').text('Input Data produk')
            modal.find('#nama_produk').val('')
            modal.find('#nama_supplier').val('')
            modal.find('#harga_beli').val('')
            modal.find('#harga_jual').val('')
            modal.find('#stok').val('')
            modal.find('#keterangan').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action', '{{ url("produk") }}')
        }
    });
</script>
@endpush