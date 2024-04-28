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
                        <h3>PELANGGAN</h3>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormPelanggan">
                                Tambah pelanggan
                            </button>
                            <a class="btn btn-success" href="{{route('export-pelanggan')}}" class="btn btn-success"><i class=" fa fa-file-excel-o"></i>Export</a>
                            <a class="btn btn-danger" href="{{route('export-pelanggan.pdf')}}" class="btn btn-danger"><i class=" fa fa-file-pdf-o"></i>Export PDF</a>
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
                            @include('pelanggan.data')
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
@include('pelanggan.form')
</section>

</div>
<!-- /page content -->
@endsection

@push('script')
<script>
    $('#tbl-pelanggan').DataTable()


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

    $('#modalFormPelanggan').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget)
        const mode = btn.data('mode')
        const nama = btn.data('nama')
        const email = btn.data('email')
        const no_telp = btn.data('no_telp')
        const alamat = btn.data('alamat')
        const id = btn.data('id')
        const modal = $(this)
        console.log(btn)
        if (mode === 'edit') {
            modal.find('.modal-title').text('Edit Data')
            modal.find('#nama').val(nama)
            modal.find('#email').val(email)
            modal.find('#no_telp').val(no_telp)
            modal.find('#alamat').val(alamat)
            modal.find('.modal-body form').attr('action', '{{ url("pelanggan")}}/' + id)
            modal.find('#method').html('@method("PATCH")')
        } else {
            modal.find('.modal-title').text('Input Data pelanggan')
            modal.find('#nama').val('')
            modal.find('#email').val('')
            modal.find('#no_telp').val('')
            modal.find('#alamat').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action', '{{ url("pelanggan") }}')
        }
    });
</script>
@endpush