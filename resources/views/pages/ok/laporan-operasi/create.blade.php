@extends('layouts.app')

@section('title', $title ?? '')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">


<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title ?? ''}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('laporan.operasi.index') }}">Laporan Operasi</a></div>
                <div class="breadcrumb-item">Add</div>
            </div>
        </div>
        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            @include('components.biodata-pasien-ok-bynoreg')
            <form action="{{ route('laporan.operasi.store') }}" method="POST">
                @csrf
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Data Operasi</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Register</label>
                                    <input type="text" name="kode_register" value="{{$biodata->pendaftaran->No_Reg}}" class="form-control @error('no_register') is-invalid @enderror" readonly>
                                    @error('no_register')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- masih salah bukan dari booking --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Operator</label>
                                    <input type="hidden" value="{{$bookingByRegister->dokter->Kode_Dokter}}" name="nama_operator">
                                    <input type="text" value="{{$bookingByRegister->dokter->Nama_Dokter}}" class="form-control @error('nama_operator') is-invalid @enderror" readonly>
                                    @error('nama_operator')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Asisten</label>
                                    <select name="nama_asisten[]" class="form-control @error('nama_asisten') is-invalid @enderror select2" multiple>
                                        <option value="" disabled>--Pilih Asisten--</option>
                                        @foreach ($asistenOperasi as $asisten)
                                        <option value="{{$asisten->kode_dokter}}">{{$asisten->nama_asisten}}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_asisten')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Perawat</label>
                                    <select name="nama_perawat[]" class="form-control @error('nama_perawat') is-invalid @enderror select2" multiple>
                                        <option value="" disabled>--Pilih Perawat--</option>
                                        @foreach ($asistenOperasi as $asisten)
                                        <option value="{{$asisten->kode_dokter}}">{{$asisten->nama_asisten}}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_perawat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Ahli Anestesi</label>
                                    <select name="nama_ahli_anastesi[]" class="form-control @error('nama_ahli_anastesi') is-invalid @enderror select2" multiple>
                                        <option value="" disabled>--Pilih Ahli Anastesi--</option>
                                        @foreach ($spesialisAnastesi as $anastesi)
                                        <option value="{{$anastesi->kode_dokter}}">{{$anastesi->nama_asisten}}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_ahli_anastesi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Perawat Anestesi</label>
                                    <select name="nama_anastesi[]" class="form-control @error('nama_anastesi') is-invalid @enderror select2" multiple>
                                        <option value="" disabled>--Pilih Penata Anastesi--</option>
                                        @foreach ($penataAnastesi as $penataAnastesi)
                                        <option value="{{$penataAnastesi->kode_dokter}}">{{$penataAnastesi->nama_asisten}}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_anastesi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jenis Anestesi</label>
                                    <input type="text" name="jenis_anastesi" class="form-control @error('jenis_anastesi') is-invalid @enderror">
                                    @error('jenis_anastesi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Laporan Operasi</h6>
                    </div>

                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Diagnosis Pre-Operatif</label>
                                    <textarea name="diagnosa_pre_op" class="form-control" id="diagnosa_pre_op" style="height: 50px;" rows="3">{{ old('diagnosa_pre_op') }}</textarea>
                                    @error('pre_operatif')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Diagnosis Post-Operatif</label>
                                    <textarea name="diagnosa_post_op" class="form-control" id="diagnosa_post_op" style="height: 50px;" rows="3">{{ old('diagnosa_post_op') }}</textarea>
                                    @error('post_operatif')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jaringan yang dieksisi</label>
                                    <textarea name="jaringan_dieksekusi" class="form-control" id="jaringan_dieksekusi" style="height: 50px;" rows="3">{{ old('jaringan_dieksekusi') }}</textarea>
                                    @error('jaringan')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dikirim untuk pemeriksaan PA</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="permintaan_pa" id="permintaan_pa1" value="1" {{ old('permintaan_pa') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pemeriksaan_pa1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="permintaan_pa" id="permintaan_pa2" value="0" {{ (old('permintaan_pa') !== '1' && old('permintaan_pa') !== '0') || old('permintaan_pa') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permintaan_pa2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @php
                            // Ambil status `use_template` dari database
                            $useTemplate = \App\Models\Operasi\UseTemplateLaporanOperasi::where('kode_dokter', auth()->user()->username)->first();
                            @endphp
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama / Macam Operasi</label>
                                    @if ($useTemplate && $useTemplate->use_template)
                                    <select name="macam_operasi" id="macam_operasi" class="form-control @error('macam_operasi') is-invalid @enderror select2">
                                        <option value="">--Pilih Macam Operasi --</option>
                                        @foreach($templates as $template)
                                            <option value="{{ $template->macam_operasi }}">{{ $template->macam_operasi }}</option>
                                        @endforeach
                                    </select>
                                    @error('macam_operasi')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    @else
                                    <input type="text" name="macam_operasi" class="form-control @error('macam_operasi') is-invalid @enderror" placeholder="Masukkan Nama Operasi" value="{{ old('macam_operasi') }}">
                                    @error('macam_operasi')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Perdarahan</label>
                                    <input type="text" name="pendarahan" class="form-control @error('pendarahan') is-invalid @enderror" value="{{ old('pendarahan') }}">
                                    @error('pendarahan')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tgl Operasi</label>
                                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{$bookingByRegister->tanggal}}" readonly>
                                    @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Mulai Operasi</label>
                                    <input type="time" name="mulai_operasi" id="mulai_operasi" class="form-control @error('mulai_operasi') is-invalid @enderror" value="{{ date('h:i', strtotime($bookingByRegister->jam_mulai))}}">
                                    @error('mulai_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Selesai Operasi</label>
                                    <input type="time" name="selesai_operasi" id="selesai_operasi" class="form-control @error('selesai_operasi') is-invalid @enderror" value="{{ date('h:i', strtotime($bookingByRegister->jam_selesai))}}">
                                    @error('selesai_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Lama Operasi</label>
                                    <div class="input-group">
                                        <input type="text" name="lama_operasi" id="lama_operasi" class="form-control @error('lama_operasi') is-invalid  
                                        @enderror" readonly>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>Jam</b>
                                            </div>
                                        </div>
                                        @error('lama_operasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Laporan Operasi</label>
                                    <textarea name="laporan_operasi" class="form-control" id="laporan_operasi" style="height: 100px;" rows="3">{{ old('laporan_operasi') }}</textarea>
                                    @error('laporan_operasi')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
</div>
</section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('rm.bymr') }}";
    }

</script>

<script>
    function toggleLabData() {
        const labCheckbox = document.getElementById('berkasLab');
        const labDataDiv = document.getElementById('labData');
        const inputs = document.querySelectorAll('#labData input');

        if (labCheckbox.checked) {
            // Tampilkan dan aktifkan input
            labDataDiv.style.display = 'block';
            labCheckbox.setAttribute('aria-expanded', 'true');
            inputs.forEach(input => input.disabled = false);
        } else {
            // Sembunyikan dan nonaktifkan input
            labDataDiv.style.display = 'none';
            labCheckbox.setAttribute('aria-expanded', 'false');
            inputs.forEach(input => {
                input.disabled = true;
                input.value = ''; // Kosongkan nilai jika tidak dipilih
            });
        }
    }

</script>

<script>
    $(document).ready(function () {
        // Menangani perubahan pada dropdown
        $("#macam_operasi").change(function () {
            
            // Ambil nilai ID yang dipilih dari select
            var macam_operasi = $("#macam_operasi").val();

            if (macam_operasi) {
                // Lakukan AJAX request ke server untuk mendapatkan laporan_operasi
                $.ajax({
                    type: "GET",
                    url: "{{ route('operasi.template.macam-operasi') }}",
                    data: {
                        macam_operasi: macam_operasi
                    },
                    success: function (data) {
                        // alert(data.data.laporan_operasi);

                        var laporanOperasi = data.data.laporan_operasi
                        // Hapus tag HTML menggunakan regex
                        laporanOperasi = laporanOperasi.replace(/<\/?[^>]+(>|$)/g, "\n"); // Menghapus tag HTML

                        // Ganti &nbsp; dengan spasi biasa
                        laporanOperasi = laporanOperasi.replace(/&nbsp;/g, " ");

                        // Hapus baris kosong ekstra (newline berturut-turut)
                        laporanOperasi = laporanOperasi.replace(/(\r\n|\r|\n){2,}/g, "\n");

                        // Hapus whitespace di awal dan akhir teks
                        laporanOperasi = laporanOperasi.trim();

                        // Set teks baru ke dalam textarea
                        $("#laporan_operasi").val(laporanOperasi);

                        // Reset dropdown
                        $(this).val(null).trigger('change');
                    },

                    error: function (xhr, status, error) {
                        // Tangani kesalahan, misalnya tampilkan pesan error
                        console.error("Error:", error);
                        alert("Terjadi kesalahan saat mengambil data.");
                    }
                });
            }
        });
    });
</script>

{{-- <script>
       $(document).ready(function () {
        $("#macam_operasi").change(function () {
            // Ambil nilai yang dipilih dari select
            var selectedValue = $(this).val();
            
            // Ambil teks lama dari textarea
            var existingText = $("#laporan_operasi").val();

            // Hapus tag HTML menggunakan regex
            selectedValue = selectedValue.replace(/<\/?[^>]+(>|$)/g, "\n"); // Menghapus tag HTML
            
            // Ganti &nbsp; dengan spasi biasa
            selectedValue = selectedValue.replace(/&nbsp;/g, " ");

            // Pastikan tidak ada baris kosong ekstra di akhir existingText
            existingText = existingText.trimEnd();

            // Tambahkan teks baru ke textarea
            if (selectedValue) {
                // Tambahkan newline hanya jika ada teks sebelumnya
                var updatedText = existingText 
                    ? existingText + "\n" + selectedValue 
                    : selectedValue;

                $("#laporan_operasi").val(updatedText);
                
                // Reset pilihan setelah teks ditambahkan (opsional)
                $(this).val(null).trigger('change');
            }
        });
    });
</script> --}}



<script>
    // Menambahkan event listener pada kedua input
    document.getElementById('mulai_operasi').addEventListener('input', calculateDuration);
    document.getElementById('selesai_operasi').addEventListener('input', calculateDuration);
    const lamaOperasi = document.getElementById('lama_operasi');

    // Fungsi untuk menghitung durasi
    function calculateDuration() {
        // Ambil nilai input jam mulai dan jam selesai
        const startTime = document.getElementById('mulai_operasi').value;
        const endTime = document.getElementById('selesai_operasi').value;

        // Pastikan kedua input memiliki nilai
        if (startTime && endTime) {
            // Ubah jam menjadi format Date untuk manipulasi waktu
            const start = new Date(`1970-01-01T${startTime}:00`);
            const end = new Date(`1970-01-01T${endTime}:00`);

            // Jika jam selesai lebih kecil dari jam mulai (misalnya, jam selesai pada hari berikutnya)
            if (end < start) {
                end.setDate(end.getDate() + 1); // Tambah satu hari pada jam selesai
            }

            // Hitung durasi dalam milidetik, kemudian konversikan ke jam
            const duration = (end - start) / 1000 / 60; // konversi milidetik ke jam

            const hours = Math.floor(duration / 60);
            const minutes = duration % 60;

            // Tampilkan hasil durasi
            lamaOperasi.value = `${hours} Jam ${minutes} Menit`;
        } else {
            lamaOperasi.value = "";
        }
    }

    // Panggil fungsi perhitungan saat halaman dimuat (untuk memastikan hasil pertama)
    window.onload = calculateDuration;

</script>
@endpush
