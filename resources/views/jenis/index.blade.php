@extends('template/layout')

@push('style') 
<!-- drng -->
@endpush

@section('content')
<!-- page content tampilan -->
<div class="right_col" role="main">

    <!-- tabel -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="dashboard_graph">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3>
                            <h3>CASHIER CAFE</h3>
                        </h3>
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
                        <h2>Jenis</h2>
                        <div class="float-right ml-auto">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormJenis">
                                <i class="fas fa-poll-h"></i> Tambah Jenis
                            </button>
                            <a class="btn btn-success" href="{{route('export-jenis')}}" class="btn btn-success><i class=" fa fa-file-excel-o"></i>Export</a>
                            <a class="btn btn-success" href="{{route('export-jenis_pdf')}}" class="btn btn-success><i class=" fa fa-file-pdf-o"></i>Export PDF</a>
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
                            @include('jenis.data')
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
@include('jenis.form')
</section>

</div>
<!-- /page content -->
@endsection

@push('script')
<script>
    // $('#tbl-jenis').DataTable()

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

    $('#modalFormJenis').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget)
        const mode = btn.data('mode')
        const nama_jenis = btn.data('nama_jenis')
        const id = btn.data('id')
        const modal = $(this)
        console.log(btn)
        if (mode === 'edit') {
            modal.find('.modal-title').text('Edit Data')
            modal.find('#nama_jenis').val(nama_jenis)
            modal.find('.modal-body form').attr('action', '{{ url("jenis")}}/' + id)
            modal.find('#method').html('@method("PATCH")')
        } else {
            modal.find('.modal-title').text('Input Data jenis')
            modal.find('#nama_jenis').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action', '{{ url("jenis") }}')
        }
    });
</script>
@endpush