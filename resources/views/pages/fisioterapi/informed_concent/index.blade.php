@extends('layouts.app')

@section('title', $title)

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
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="">Fisioterapi</a></div>
                <div class="breadcrumb-item"><a href="">Informed Concent</a></div>
                <div class="breadcrumb-item">List Pasien</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Alamat</th>
                                 
                                    <th scope="col">Aksi</th>
                                    <th scope="col">Hasil Surat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listpasien as $data)
                                    <tr>
                                        <td>
                                            <span class="badge badge-pill badge-success">{{ $loop->iteration }}</span></td>
                                        <td>{{$data->NO_MR}}</td>
                                        <td>{{$data->NAMA_PASIEN}}</td>
                                        <td>{{$data->ALAMAT}}</td>
                            
                                        <td width="15%">
                                            <a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-add-informed-concent{{$data->NO_REG}}"><i class="fa fa-plus"></i> Informed Concent</a>   
                                            <a href="{{ route('rujukan.add', ['no_reg' => $data->NO_REG
                                            ])}}" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> Surat Rujuk</a>   
                                        </td>
                                        <td width="20%">
                                            @if($fisioModel->cekInformedConcent($data->NO_REG) == true)
                                            <a href="{{ route('berkas.informed', ['no_reg' => $data->NO_REG
                                            ])}}" class="btn btn-sm btn-warning" ><i class="fa fa-download"></i> Surat Informed Concent</a>
                                            @endif  

                                            @if($fisioModel->cekSuratRujukan($data->NO_REG) == true)
                                            <a href="{{ route('berkas.rujukan', ['no_reg' => $data->NO_REG
                                            ])}}" class="btn btn-sm btn-warning" ><i class="fa fa-download"></i> Surat Rujukan</a>
                                            @endif  
                                            <a href="{{ route('informed_concent.cetakPersetujuan', ['noReg' => $data->NO_REG
                                            ])}}" class="btn btn-sm btn-success">Surat Persetujuan</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@foreach ($listpasien as $data)
<div class="modal fade" id="modal-add-informed-concent{{$data->NO_REG}}">">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Surat Informed Concent</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('informed_concent.add_proses') }}" method="POST">
                @csrf
                <div class="card-body">
                    
                <div class="container">
                                <p><b>Nama : {{$data->NAMA_PASIEN}} <br> No MR : {{$data->NO_MR}} <br> Dengan ini menyatakan sesungguhnya memberikan PERSETUJUAN, untuk dilakukan tindakan fisioterapi : </b></p>
                            </div>
                        <div class="col-md-12">
                   
                            <div class="form-group">
                                <label>Terhadap</label>
                                <input type="hidden" name="KODE_REGISTER" value="{{$data->NO_REG}}">
                                <select name="IDENTIFIKASI" class="form-control">
                                    <option value="" disabled selected>--pilih--</option>
                                    <option value="Diri sendiri" selected>Diri sendiri</option>
                                    <option value="Suami">Suami</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Ayah">Ayah</option>
                                    <option value="Ibu">Ibu</option>
                                </select>     
                            </div>
                        </div>

                        <div class="col-md-12">
                   
                            <div class="form-group">
                                <label>Ruangan/kamar</label>
                              <input type="text" name="RUANGAN" class="form-control">    
                            </div>
                        </div>
                
                </div>

            </div>
            <div class="card-footer text-left">
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Simpan</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endforeach
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

@endpush