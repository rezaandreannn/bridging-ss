@extends('layouts.app')

@section('title', $title ?? '')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title ?? ''}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('layanan.assesmenPerawat') }}">Layanan IGD</a></div>
                <div class="breadcrumb-item">Triase</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card card-primary">
              
                    <div class="card-body card-khusus-body">
                        <div class="section-title">Pasien Sudah Mendaftar</div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-check pl-5">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Sudah" id="rencana_tindakan1" onclick="click_kondisi_pulang(this)">
                                        <label class="form-check-label" for="rencana_tindakan1">
                                            Sudah
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Belum" id="rencana_tindakan2" onclick="click_kondisi_pulang(this)">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Belum
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-12" id="form1" style="display: none">
                                    <div class="form-group">
                                        <div class=" col-md-6">
                                            <label>Pilih Pasien</label>
                                            <select name="pasien" id="" class="form-control select2">
                                                <option value="">pilih pasien</option>
                                                <option value="">tes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="form2" style="display: none">
                                    <div class="form-group">
                                        <div class=" col-md-6">
                                            <label>Nama Pasien</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="form3" style="display: none">
                                    <div class="form-group">
                                        <div class=" col-md-6">
                                            <label>Alamat</label>
                                            <input type="text" name="" id="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               
            </div>

            <div class="card card-primary">
                <div class="card-header card-success card-khusus-header">
                    <h6 class="card-khusus-title">Kontak Awal Dengan Pasien</h6>
                </div>
                <div class="card-body card-khusus-body">
                    <form action="{{ route('asesmenStore.dokterNew') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal dan jam </label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid  
                                        @enderror" value="{{ date('Y-m-d')}}">
                                            @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class=" col-md-6">
                                            <input type="time" name="jam" class="form-control" value="{{date('H:i:s')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Cara Masuk</label>
                                    <div class="row">
                                        <div class="form-check pl-5">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Jalan" id="rencana_tindakan1" onclick="click_kondisi_pulang(this)">
                                            <label class="form-check-label" for="rencana_tindakan1">
                                                Jalan
                                            </label>
                                        </div>
                                        <div class="form-check pl-4">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Brandkar" id="rencana_tindakan2" onclick="click_kondisi_pulang(this)">
                                            <label class="form-check-label" for="rencana_tindakan2">
                                                Brandkar
                                            </label>
                                        </div>
                                        <div class="form-check pl-4">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Kursi Roda" id="rencana_tindakan2" onclick="click_kondisi_pulang(this)">
                                            <label class="form-check-label" for="rencana_tindakan2">
                                                Kursi Roda
                                            </label>
                                        </div>
                                        <div class="form-check pl-4">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Digendong" id="rencana_tindakan2" onclick="click_kondisi_pulang(this)">
                                            <label class="form-check-label" for="rencana_tindakan2">
                                                Digendong
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                        <label for="">Sudah Terpasang</label>
                                        <input type="text" class="form-control">
                                </div>
                            </div>


                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cara Pasien Datang</label>
                                    <select name="JENIS_FISIO[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Cara Pulang" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <option value="" disabled>-- Pilih Cara Pulang --</option>
                                        <option value="#">Sendiri</option>
                                        <option value="#">Diantar</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="card-header card-success">
                                <h4 class="card-title">Analisa</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Diagnosa Klinis <code>*</code></label>
                                    <textarea class="form-control @error('diagnosa_klinis') is-invalid  
                                    @enderror" rows="3" name="diagnosa_klinis"  placeholder="Masukan ..."></textarea>
                                    @error('diagnosa_klinis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                      
                            </div>
                            {{-- <div class="col-md-12">
                                <div class="form-group">
                                    <label>Diagnosa Klinis <code>*</code></label>
                                    <textarea class="form-control @error('diagnosa_klinis') is-invalid  
                                        @enderror" rows="3" name="diagnosa_klinis" value="" placeholder="Masukan ...">{{ old('diagnosa_klinis')}}</textarea>
                                </div>
                                @error('diagnosa_klinis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}
                            <div class="card-header card-success">
                                <h4 class="card-title">Perencanaan</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Terapi <code>*</code></label>
                                    <textarea class="form-control @error('jenis_terapi_fisio') is-invalid  
                                    @enderror" rows="3" name="jenis_terapi_fisio"  placeholder="Masukan ..."></textarea>
                                    @error('jenis_terapi_fisio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rencana Tindakan</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rencana_tindakan" value="Tidak Ada" id="rencana_tindakan1" checked>
                                                    <label class="form-check-label" for="rencana_tindakan1">
                                                        Tidak Ada
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rencana_tindakan" value="Ya" id="rencana_tindakan2">
                                                    <label class="form-check-label" for="rencana_tindakan2">
                                                        Ya
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <input type="text" name="jenis_tindakan" class="form-control @error('jenis_tindakan') is-invalid  
                                        @enderror" value="{{old('jenis_tindakan')}}" placeholder="Isi jenis tindakan jika ya">
                                        </div>
                                        @error('jenis_tindakan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rujuk</label>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rencana_rujukan" value="Tidak Ada" id="rencana_rujukan1" checked>
                                                    <label class="form-check-label" for="rencana_rujukan1">
                                                        Tidak Ada
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rencana_rujukan" value="Ya" id="rencana_rujukan2">
                                                    <label class="form-check-label" for="rencana_rujukan2">
                                                        Ya
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rujukan Ke : </label>
                                        <input type="text" name="deskripsi_rujukan" class="form-control @error('deskripsi_rujukan') is-invalid  
                                    @enderror" value="{{old('deskripsi_rujukan')}}" placeholder="Rujukan Ke">
                                    @error('deskripsi_rujukan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                            
                           
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Konsul</label>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rencana_konsul" value="Tidak Ada" id="rencana_konsul1" checked>
                                                <label class="form-check-label" for="rencana_konsul1">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rencana_konsul" value="Ya" id="rencana_konsul2" >
                                                <label class="form-check-label" for="rencana_konsul2">
                                                    Ya
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ke bagian : </label>
                                    <input type="text" name="deskripsi_konsul" class="form-control @error('deskripsi_konsul') is-invalid  
                                        @enderror" value="{{old('deskripsi_konsul')}}" placeholder="Ke Bagian">
                                </div>
                                @error('deskripsi_konsul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Anjuran</label>
                                    <div class="input-group">
                                        <select name="anjuran_terapi" id="" class="form-control @error('anjuran_terapi')  is-invalid @enderror">
                                            <option value="" disabled>--Pilih Anjuran--</option>
                                            <option value="1">1</option>
                                            <option value="2" selected>2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                        @error('anjuran_terapi')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>Seminggu</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Evaluasi</label>
                                    <div class="input-group">
                                        <select name="evaluasi_terapi" id="" class="form-control @error('evaluasi_terapi')  is-invalid @enderror">
                                            <option value="" selected disabled>--Pilih Evaluasi--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8" selected>8</option>
                                        </select>
                                        @error('evaluasi_terapi')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>Terapi</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Instrumen Uji Fungsi / Prosedur KFR : <code>*</code></label>
                                    <textarea class="form-control @error('prosedur_kfr') is-invalid  
                                        @enderror" rows="3" name="prosedur_kfr"  placeholder="Masukan ...">MMT AGA=4/5, AGB=4/5</textarea>
                                        @error('prosedur_kfr')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kesimpulan : </label>
                                    <textarea class="form-control @error('kesimpulan') is-invalid  
                                        @enderror" rows="3" name="kesimpulan"  placeholder="Masukan ...">Gangguan ADL, gangguan kerja, gangguan mobilitas</textarea>
                                        @error('kesimpulan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Rekomendasi : </label>
                                    <textarea class="form-control @error('rekomendasi') is-invalid  
                                        @enderror" rows="3" name="rekomendasi"  placeholder="Masukan ...">Terapi sesuai anjuran</textarea>
                                        @error('rekomendasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Edukasi : </label>
                                    <textarea class="form-control" rows="3" name="edukasi"  placeholder="Masukan ...">Latihan sesuai anjuran</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Suspek Penyakit Akibat Kerja</label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="penyakit_akibat_kerja" value="Ya" id="penyakit_akibat_kerja1">
                                        <label class="form-check-label">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="penyakit_akibat_kerja" value="Tidak" id="penyakit_akibat_kerja2" checked>
                                        <label class="form-check-label">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Deskrispsi suspek penyakit akibat kerja <code>Isi jika ya</code></label>
                                    <input type="text" class="form-control" name="deskripsi_akibat_kerja" value="{{ old('deskripsi_akibat_kerja')}}"  placeholder="Masukan ..."></input>
                                
                                </div>
                            </div>
                            {{-- <div class="col-md-9">

                            </div>
                            <div class="col-md-3">
                                Tanda Tangan
                            </div>
                            <div class="col-md-9">

                            </div>
                            <div class="col-md-3">
                                {!! DNS2D::getBarcodeHTML($biodatas->No_MR, 'QRCODE', 2, 2) !!}
                            </div>
                            <div class="col-md-9">

                            </div>
                            <div class="col-md-3">
                                (Nama Dokter Pemeriksa)
                            </div> --}}
                        </div>
                
                </div>
                <div class="card-body card-khusus-body">
                    <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
              
                    </div>
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
    function click_kondisi_pulang(selected) {
        var checkbox1 = selected.value;

        // Hide all forms initially
        $("#form1, #form2, #form3").hide();

        // Show the relevant forms based on selected value
        if (checkbox1 === "Sudah") {
            $("#form1").show();
        } else if (checkbox1 === "Belum") {
            $("#form2, #form3").show();
        }
    }
</script>

@endpush