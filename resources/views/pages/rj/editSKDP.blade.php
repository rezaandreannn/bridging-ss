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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h6 class="mt-1">{{ $rajal['NAMA_PASIEN'] ?? ''}} - ({{ $rajal['NO_MR'] ?? ''}})</h6>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <h6 class="mb-0"><b></b></h6>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="media-title">Kode Reg :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $rajal['No_Reg']}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Nama Dokter :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $rajal['NAMA_DOKTER'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title">Jenis Kelamin :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> @if ($rajal['JENIS_KELAMIN'] == 'L')
                                                    Laki-Laki
                                                    @else
                                                    Perempuan
                                                    @endif</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Tanggal Lahir :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1">{{ date('d-m-Y', strtotime($rajal['TGL_LAHIR'] ?? '')) }}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Alamat :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $rajal['ALAMAT'] ?? ''}}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- form -->
            <form action="#" method="post">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Surat Keterangan Dalam Perawatan</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Belum dapat dikembalikan ke Fasilitas Perujuk dengan alasan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control selectric" name="FS_SKDP_1" id="FS_SKDP_1" onchange="click_alasan_skdp(this)">
                                        <option value=''>--Pilih Alasan--</option>
                                        @foreach ($alasanSkdp as $skdpalasan)
                                        <option value="{{$skdpalasan->FS_KD_TRS}}">{{$skdpalasan->FS_NM_SKDP_ALASAN}}</option>

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
                                    <select class="form-control selectric" name="FS_SKDP_2" id="rencana_skdp">
                                        <option value=''>--Pilih Rencana Tindakan--</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="FS_SKDP_KET" class="form-control" value="" placeholder="keterangan">
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
                                        <option value="1 Minggu Kedepan">1 Minggu Kedepan</option>
                                        <option value="2 Minggu Kedepan">2 Minggu Kedepan</option>
                                        <option value="Sebulan Kedepan" selected="">Sebulan Kedepan</option>
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
                                    <input type="date" name="FS_SKDP_KONTROL" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Expired rujukan faskes : </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="date" name="FS_SKDP_FASKES" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Keterangan atau pesan : </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea name="FS_PESAN" id="" cols="55" rows="5"></textarea>
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
            type: "POST",
            url: "{{ route('rj.skdp_rencana_kontrol') }}",
            data: {
                FS_SKDP_1: FS_SKDP_1
            },
            async: false,
            dataType: 'json',

            success: function(data) {
                //jika data sukses diambil dari server kita tampilkan
                //di <select id=kota
                alert(data);
                die;
                var html = '';
                var i;


                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].FS_KD_TRS + '>' + data[i].FS_NM_SKDP_RENCANA + '</option>';
                }
                $('#rencana_skdp').html(html);

            }
        });
    }
</script>

@endpush