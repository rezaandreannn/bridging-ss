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
<link rel="stylesheet" href="{{ asset('ttd/css/jquery.signature.css') }}">

<style>
    .kbw-signature {
        width: 100%;
        height: 250px;
    }
    
    .eye-image {
         max-width: 100%;
         }
     .custom-judul{
         font-size: 18px;
         padding-left: 20px;
         color: #6777ef;
         margin-bottom: 0;
         width: 100%;
     }
     .no-margin {
         margin: 0;
     }
     .no-padding {
             padding: 0;
     }
     .align-items-center {
             display: flex;
             align-items: center;
             margin: 0;
     }
     @media (max-width: 768px) {
             .text-right-mobile {
                 text-align: right;
                 font-size: 6px;
             }
             .text-left-mobile {
                 text-align: left;
                 font-size: 6px;
             }
             .eye-image {
                 max-width:100px;
             }
             .my-mobile {
                 margin-top: 2rem !important;
                 margin-bottom: 1rem !important;
             }
            .kbw-signature {
                width: 100%;
                height: 250px;
            }
        }
        .my-0 {
                margin-top: -10px !important;
                margin-bottom: 0 !important;
        }
        .my-1 {
                margin-bottom: -30px !important;
        }
 </style>
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Kondisi Pulang</a></div>
                <div class="breadcrumb-item">SKDP</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no reg -->
                    @include('components.biodata-pasien-bynoreg')
                    <form id="myForm" action="{{ route('kondisiPulang.SkdpAdd') }}" method="POST">
                    @csrf
                      {{-- surat menyurat  --}}
                      <div class="card card-success">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Surat Keterangan Dalam Perawatan</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <!-- <div class="row"> -->
                            <div class="col-md-6">
                                    <label>Belum dapat dikembalikan ke Fasilitas Perujuk dengan alasan</label>
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="FS_KD_REG" value="{{ $biodata->NO_REG }}" />
                                        <select name="FS_SKDP_1" id="FS_SKDP_1" class="form-control select2" onchange="click_alasan_skdp(this)">
                                            <option value="">-- pilih --</option>
                                            @foreach ($alasanSkdp as $skdpalasan)
                                                @if($skdpalasan->FS_KD_TRS != 6)
                                                    <option value="{{ $skdpalasan->FS_KD_TRS }}" {{ ($skdpalasan->FS_KD_TRS) ? 'selected' : '' }}>
                                                        {{ $skdpalasan->FS_NM_SKDP_ALASAN }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Rencana tindak lanjut yang akan dilakukan pada kunjungan selanjutnya :</label>
                                    <div class="input-group mb-3">
                                        <select name="FS_SKDP_2" id="rencana_skdp" class="form-control select2">
                                            <option value="1">--Pilih Rencana Tindakan--</option>
                                        </select>
                                        <input type="text" name="FS_SKDP_KET" class="form-control" placeholder="keterangan.." />       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Rencana Kontrol Berikutnya : </label>
                                <div class="input-group mb-3">
                                    <select name="FS_RENCANA_KONTROL" id="FS_RENCANA_KONTROL" class="form-control select2" onchange="click_rencana_kontrol(this)">
                                        <option value="">-- pilih --</option>
                                        <option value="1 Minggu">1 Minggu</option>
                                        <option value="2 Minggu">2 Minggu</option>
                                        <option value="Sebulan Kedepan">Sebulan Kedepan</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                    <label>contoh </label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="kontrol"  class="form-control" id="kontrol_rencana">
                                    </div>
                                </div> -->
                            <div class="col-md-6">
                                <label>Tanggal Kontrol Berikutnya : </label>
                                <div class="input-group mb-3">
                                    <input type="date" name="FS_SKDP_KONTROL" class="form-control" id="tgl_kontrol_berikutnya">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Tanggal Expired Rujukan Faskes : </label>
                                <div class="input-group mb-3">
                                    <input type="date" name="FS_SKDP_FASKES" value="{{ $tanggalExpried->FS_SKDP_FASKES ?? ''}}" id="FS_SKDP_FASKES" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Keterangan Atau Pesan : </label>
                                <div class="input-group mb-3">
                                    <textarea class="form-control" rows="3" name="FS_PESAN"  placeholder="Masukan ..."></textarea>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="text-left">
                        {{-- <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button> --}}
                        {{-- <a href="{{ route('poliMata.assesmenAwal', ['noReg' => $biodata->NO_REG]) }}" class="btn btn-primary mb-2"><i class="fas fa-save"></i>Simpan</a> --}}
                        <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                    </div>
                    </form>
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
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.signature.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#myForm input').on('keypress', function(event) {
            if (event.which === 13) {
                event.preventDefault(); // Mencegah pengiriman form
            }
        });
    });
</script>

<script>
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