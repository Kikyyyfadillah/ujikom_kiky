<!-- modal -->
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-compact table stripped" id="tbl-absensi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama_karyawan</th>
                    <th>Tanggal_masuk</th>
                    <th>Waktu_masuk</th>
                    <th>Status</th>
                    <th>Waktu_keluar</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <tbody>
                <!-- pengulangan foreach -->
                @foreach ($absensi as $p) 
                <!-- parameter -->
                <!-- mengambil data dari data tabel variabel jenis-->
                <tr>
                    <td>{{ $i = !isset ($i) ? ($i = 1) : ++$i }}</td>
                    <td>{{ $p->nama_karyawan }}</td>
                    <td>{{ $p->tanggal_masuk }}</td>
                    <td>{{ $p->waktu_masuk }}</td>
                    <td>
                        <div class="col-sm-10">
                            <select name="status" id="status" class="form-control">
                                {{-- <option value="">Status</option> --}}
                                <option value="Masuk">Masuk</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Cuti">Cuti</option>
                            </select>
                        </div>
                    </td>
                    <!-- <td> {{ $p->waktu_keluar }}</td> -->
                    <td>
                        @if ($p->nama_karyawan && $p->tanggal_masuk && $p->waktu_masuk && $p->status)
                        <button type="button" class="btn btn-primary" id="btnSelesai_{{ $p->id }}" onclick="tampilkanWaktu('{{ $p->id }}')">Selesai</button>
                        @else
                        <!-- Tampilkan pesan kosong jika input lain belum terisi -->
                        -
                        @endif
                    </td>

                    <script>
                        function tampilkanWaktu(id) {
                            // Dapatkan elemen tombol yang diklik
                            var tombol = document.getElementById("btnSelesai_" + id);

                            // Buat objek Date untuk mendapatkan waktu sekarang
                            var waktuSekarang = new Date();

                            // Dapatkan komponen waktu (jam, menit, detik)
                            var jam = waktuSekarang.getHours();
                            var menit = waktuSekarang.getMinutes();
                            var detik = waktuSekarang.getSeconds();

                            // Format waktu menjadi string yang sesuai
                            var waktuString = jam + ":" + menit + ":" + detik;

                            // Tambahkan waktu ke dalam tombol
                            tombol.innerText = waktuString;
                        }
                    </script>
                    <td>
                        <button class="btn text-warning" data-toggle="modal" data-target="#modalFormAbsensi" data-mode="edit" data-id="{{ $p->id }}" data-nama_karyawan="{{ $p->nama_karyawan }}" data-tanggal_masuk="{{ $p->tanggal_masuk }}" data-waktu_masuk="{{ $p->waktu_masuk }}" data-status="{{ $p->status }}" data-waktu_keluar="{{ $p->waktu_keluar }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form method="post" action="{{ route('absensi.destroy', $p->id) }}" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn text-danger btn-delete" data-nama="{{ $p->nama_karyawan }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>