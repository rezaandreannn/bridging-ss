@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
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
                <div class="breadcrumb-item active"><a href="{{ route('rj.index') }}">Nurse Record</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.index') }}">Pasien</a></div>
                <div class="breadcrumb-item">Edit SKDP</div>
            </div>
        </div>

        <div class="section-body">
            <!-- Detail Pasien -->
            @include('components.biodata-pasien-bynoreg')
            <!-- form -->
            <form action="{{ route('rj.updateSkdp',$biodata->NO_REG) }}" method="POST">
            @csrf
                @method('put')
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Surat Keterangan Dalam Perawatan</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="FS_KD_REG" class="form-control" value="{{ $biodata->NO_REG}}" placeholder="keterangan">
                                <input type="hidden" name="Kode_Dokter" class="form-control" value="{{ $biodata->Kode_Dokter}}" placeholder="keterangan">
                                <div class="form-group">
                                    <label>Belum dapat dikembalikan ke Fasilitas Perujuk dengan alasan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control selectric" name="FS_SKDP_1" id="FS_SKDP_1" onchange="click_alasan_skdp(this)">
                                        <option value=''>--Pilih Alasan--</option>
                                        @foreach ($alasanSkdp as $skdpalasan)
                                        <option value="{{$skdpalasan->FS_KD_TRS}}" {{ ($skdp->FS_SKDP_1 == $skdpalasan->FS_KD_TRS ) ? 'selected' : '' }}>{{$skdpalasan->FS_NM_SKDP_ALASAN}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rencana tindak lanjut yang akan dilakukan pada kunjungan selanjutnya : </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select id="rencana_skdp" class="form-control" name="FS_SKDP_2" >
                                        <option value=''>--Pilih Rencana Tindakan--</option>
                                        @foreach ($rencanaSkdp as $renSkdp)
                                        <option value="{{$renSkdp->FS_KD_TRS}}" {{ ($skdp->FS_SKDP_2 == $renSkdp->FS_KD_TRS ) ? 'selected' : '' }}>{{$renSkdp->FS_NM_SKDP_RENCANA}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="FS_SKDP_KET" class="form-control" value="{{$skdp->FS_SKDP_KET}}" placeholder="keterangan">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rencana Kontrol Berikutnya :</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control selectric" name="FS_RENCANA_KONTROL">
                                        <option value="1 Minggu Kedepan"  {{ ($skdp->FS_RENCANA_KONTROL == '1 Minggu Kedepan' ) ? 'selected' : '' }}>1 Minggu Kedepan</option>
                                        <option value="2 Minggu Kedepan" {{ ($skdp->FS_RENCANA_KONTROL == '2 Minggu Kedepan' ) ? 'selected' : '' }}>2 Minggu Kedepan</option>
                                        <option value="Sebulan Kedepan" {{ ($skdp->FS_RENCANA_KONTROL == 'Sebulan Kedepan' ) ? 'selected' : '' }}>Sebulan Kedepan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Kontrol Berikutnya : </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="date" name="FS_SKDP_KONTROL" class="form-control" value="{{$skdp->FS_SKDP_KONTROL}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Expired rujukan faskes : </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="date" name="FS_SKDP_FASKES" class="form-control" value="{{$skdp->FS_SKDP_FASKES}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Keterangan atau pesan : </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea name="FS_PESAN" id="" cols="55" rows="5">{{$skdp->FS_PESAN}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                <!-- button -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                </div>
                <!-- button -->
                <!-- form -->
            </form>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script type="text/javascript">

    function click_alasan_skdp(selected) {

        var FS_SKDP_1 = $("#FS_SKDP_1").val();

        $.ajax({
            type: "GET",
            url: "{{ route('rj.skdp_rencana_kontrol') }}",
            data: {
                FS_SKDP_1: FS_SKDP_1
            },
            async: false,
            dataType: 'json',

            success: function(data) {
                //jika data sukses diambil dari server kita tampilkan
                //di <select id=kota
     
      
           
                var html = '';
                var i;
                let array = data.data;


                for (i = 0; i < array.length; i++) {
                    
                  
                    html += '<option value=' + array[i].FS_KD_TRS + '>' + array[i].FS_NM_SKDP_RENCANA + '</option>';
                    
                }
                $('#rencana_skdp').html(html);

            }
        });
    }
</script>

@endpush