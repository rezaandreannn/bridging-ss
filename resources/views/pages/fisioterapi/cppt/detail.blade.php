@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<!-- Select -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('list-pasien.index') }}">Fisioterapi</a></div>
                <div class="breadcrumb-item">CPPT Fisioterapi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no mr -->
                    @include('components.biodata-pasien-fisio-bymr')
                    <!-- components biodata pasien by no mr -->
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary ">
                        <div class="card-header card-success card-khusus-header">
                            <h6 class="card-khusus-title">Tambah Data CPPT Fisioterapi</h6>
                        </div>
                        <div class="card-body card-khusus-body">
                            <form action="{{ route('cppt.tambahData') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Transaksi </label>
                                            <input type="hidden" class="form-control" value="{{ $cppt->ID_TRANSAKSI }}" name="ID_TRANSAKSI" readonly>
                                            <input type="text" class="form-control" value="{{ $cppt->KODE_TRANSAKSI_FISIO}}" name="KODE_TRANSAKSI_FISIO" readonly>
                                            <input type="hidden" class="form-control" name="NO_MR_PASIEN" value="{{ $cppt->NO_MR_PASIEN }}" readonly>
                                            <input type="hidden" class="form-control" name="no_registrasi" value="{{ $biodatas->No_Reg }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal dan jam Terapi </label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="TANGGAL_FISIO" class="form-control" value="{{date('Y-m-d')}}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="time" name="JAM_FISIO" class="form-control" value="{{date('H:i:s')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ((auth()->user()->roles->pluck('name')[0])=='dokter fisioterapi')
                                    <input type="hidden" name="KODE_DOKTER" class="form-control" value="{{ auth()->user()->username }}" readonly>
                                    @else
                                    <input type="hidden" name="KODE_DOKTER" class="form-control" value="028" readonly>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                            <textarea class="form-control" rows="2" name="ANAMNESA"  placeholder="Masukan ...">@if ($cekasesmenDokter==true) {{$asesmenDokterFisio->anamnesa}} @elseif ($cektransaksicppt==true) {{$transaksiFisio->ANAMNESA}} @elseif ($cekasesmenperawat == true){{$asesmen_perawat->FS_ANAMNESA}} @else @endif</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diagnosa <code>*</code></label>
                                            <textarea class="form-control" rows="2" name="DIAGNOSA" value="" placeholder="Masukan ..." @if ((auth()->user()->roles->pluck('name')[0])!='dokter fisioterapi') readonly  @endif>@if($cekasesmenDokter==true) {{$asesmenDokterFisio->diagnosa_klinis}} @elseif ($cektransaksicppt==true){{$transaksiFisio->DIAGNOSA}} @else @endif</textarea>
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tekanan Darah</label>
                                            <input type="text" name="TEKANAN_DARAH" id="tekananDarah" class="form-control" @if ($cekttv==true) value="{{$ttv->FS_TD}}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nadi</label>
                                            <input type="text" name="NADI" id="nadi" class="form-control" @if ($cekttv==true) value="{{$ttv->FS_NADI}}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Suhu</label>
                                            <input type="text" name="SUHU" id="suhu" class="form-control" @if ($cekttv==true)  value="{{$ttv->FS_SUHU}}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Lain-lain</label>
                                            <textarea name="LAINNYA" style="height: 80px;" class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                              <h6 class="card-subtitle mb-2"> <span class="badge badge-pill badge-info"><i class="fas fa-info"></i></span> Terapi yang diberikan dokter</h6>
                                              <hr>
                                              <p>{{$terapiDokterLastFisio->terapi ?? ''}}</p>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Fisio</label>
                                            <select name="JENIS_FISIO[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Jenis Fisio" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled>-- Pilih Jenis Fisio --</option>
                                                @foreach ($jenisfisio as $terapi)
                                                <option value="{{ $terapi->NAMA_TERAPI }}">{{ $terapi->NAMA_TERAPI }}</option>
                                                @endforeach
                                          
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cara Pulang </label>
                                            <select name="CARA_PULANG" id="" class="form-control select2" onchange="click_kondisi_pulang(this)">
                                                <option value="" disabled>--Pilih--</option>
                                                <option value="KONSULTASI" selected>KONSULTASI</option>
                                                <option value="RUJUK">RUJUK</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div id="form2" style="display: none">
                            <div class="card-header card-success card-khusus-header">
                                <h6 class="card-khusus-title">Tambah Surat Rujukan</h6>
                            </div>
                            <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tujuan Rujukan <code>*</code></label>
                                        <input type="hidden" name="kode_registrasi" value="" class="form-control">
                                        <input type="text" name="tujuan_rujukan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat Tujuan Rujukan</label>
                                        <input type="text" name="alamat_rujukan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alasan dirujuk</label>
                                        <input type="text" name="alasan_rujuk" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>penerima telepon di RS tujuan</label>
                                        <input type="number" name="nohp_tujuan" class="form-control">
                                    </div>
                                </div>
                                </div>
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
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-success">
                            <a href="{{ route('transaksi_fisio.fisio', ['no_mr' => $biodatas->NO_MR])}}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-rotate-back"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal & Jam</th>
                                            <th>Anamnesa & Pemeriksaaan</th>
                                            <th>Diagnosa</th>
                                            <th>Terapi</th>
                                            <th>Dokter</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        use Carbon\Carbon;
                                        @endphp
                                        @foreach ($data as $cppt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$cppt->TANGGAL_FISIO}} & {{ date('G:i', strtotime($cppt->JAM_FISIO))}} WIB</td>
                                            <td>S = {{$cppt->ANAMNESA}} <br>O = TD = {{$cppt->TEKANAN_DARAH}}, N = {{$cppt->NADI}}, T = {{$cppt->SUHU}} , Lainnya = {{$cppt->LAINNYA}}</td>
                                            <td>{{$cppt->DIAGNOSA}}</td>
                                            <td>{{$cppt->JENIS_FISIO}}</td>
                                            <td>@if($cppt->KODE_DOKTER == '151')
                                                {{ $cppt->name . ' (Dokter SPKFR)' }}
                                                @else
                                                {{ $cppt->name . ' (Fisioterapis)' }}
                                                @endif
                                            </td>
                                            <td width="20%">

                                                @php
                                                $tanggalFisio = Carbon::parse($cppt->TANGGAL_FISIO)->toDateString();
                                                $tanggalSekarang = Carbon::now()->toDateString();
                                                @endphp

                                                
                                                @if ($tanggalFisio !== $tanggalSekarang)
                                                @can('edit riwayat cppt')
                                                <a href="{{ route('cppt.editRiwayat', ['id' => $cppt->ID_CPPT_FISIO]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit Riwayat</a>
                                                @endcan
                                                @can('hapus riwayat cppt')
                                                <form id="delete-form-{{$cppt->ID_CPPT_FISIO}}" action="{{ route('cppt.deleteData', $cppt->ID_CPPT_FISIO) }}" method="POST" style="display: none;">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                                <a class="btn btn-sm btn-danger" confirm-delete="true" data-menuId="{{$cppt->ID_CPPT_FISIO}}" href="#"><i class="fas fa-trash"></i> Hapus Riwayat</a>
                                                @endcan
                                                @endif
                                              
                                      
                                                @if ($tanggalFisio === $tanggalSekarang)
                                                <a href="{{ route('cppt.edit', ['id' => $cppt->ID_CPPT_FISIO]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>
                                                <form id="delete-form-{{$cppt->ID_CPPT_FISIO}}" action="{{ route('cppt.deleteData', $cppt->ID_CPPT_FISIO) }}" method="POST" style="display: none;">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                                <a class="btn btn-sm btn-danger" confirm-delete="true" data-menuId="{{$cppt->ID_CPPT_FISIO}}" href="#"><i class="fas fa-trash"></i> Hapus</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<!-- Membatasi inputan huruf -->
<script>
    document.getElementById('tekananDarah').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('suhu').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('nadi').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
</script>

<SCript>
        function click_kondisi_pulang(selected) {
        $("#form2").hide();

        var checkbox1 = selected.value

        if (checkbox1 == "RUJUK") {
            $("#form2").show();
        }  else {
            $("#form2").hide();
        
        }
    }
</SCript>

<!-- Delete Data -->
<script>
$(document).ready(function() {
    // Inisialisasi DataTable
    var table = $('#table-1').DataTable();

    // Event delegation untuk tombol delete
    $('#table-1').on('click', '[confirm-delete="true"]', function(event) {
        event.preventDefault();
        var menuId = $(this).data('menuid');
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6777EF',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = $('#delete-form-' + menuId);
                if (form.length) {
                    form.submit();
                } else {
                    console.error('Data will not be deleted!:', menuId);
                }
            }
        });
    });
});
</script>

@endpush