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
                <div class="breadcrumb-item active"><a href="{{ route('list-pasien.index') }}">Fisioterapi</a></div>
                <div class="breadcrumb-item">CPPT Fisioterapi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No Antrian</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Periksa</th>
                                    <th scope="col">Status CPPT</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listpasien as $pasien)
                                <tr>
                                    <td><span class="badge badge-pill badge-success">{{ $pasien->Nomor }}</span></td>
                                    <td>{{ $pasien->No_MR }}</td>
                                    <td>{{ $pasien->Nama_Pasien }}</td>
                                    <td>{{ $pasien->Alamat }}</td>
                                    <td>
                                        @if($fisioterapi->cek_asesmen_dokter_fisio($pasien->NO_REG)==true && $pasien->FS_STATUS == '')
                                        <div class="badge badge-success">Dokter Selesai</div>
                                        <div class="badge badge-warning">Perawat Belum</div>
                                        @elseif($fisioterapi->cek_asesmen_dokter_fisio($pasien->NO_REG)==true && $pasien->FS_STATUS == '1')
                                        <div class="badge badge-success"><i class="fa-solid fa-check"></i></div>
                                        @elseif($pasien->FS_STATUS == '')
                                        <div class="badge badge-warning text-white">Perawat</div>
                                        @elseif($pasien->FS_STATUS == '1')
                                        <div class="badge badge-danger">Dokter</div>

                                        @endif
                                    </td>
                                
                                    <td>
                                        @if ($fisioterapi->cek_cppt($pasien->NO_REG)==true)
                                        <div class="badge badge-success"><i class="fa-solid fa-check"></i></div>  
                                        @else
                                        <div class="badge badge-danger">belum</div>
                                        @endif
                                    </td>
                                    <td width="15%">
                                        @if ($fisioterapi->cek_asesmen_dokter_fisio($pasien->NO_REG)==true)
                                        <button data-toggle="modal" data-target="#modal-edit{{$pasien->NO_REG}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</button>
                                        @else
                                        {{-- tombol lama --}}
                                        {{-- <a href="{{ route('add.dokter', $pasien->No_MR)}}" class="btn btn-sm btn-primary"><i class="fas fa-notes-medical"></i> Entry</a> --}}
                                        {{-- tombol lama --}}
                                        {{-- @if($pasien->FS_STATUS == 1) --}}
                                        <a href="{{ route('add.dokterNew', ['NoMr' => $pasien->No_MR, 'noReg' => $pasien->NO_REG])}}" class="btn btn-sm btn-primary"><i class="fas fa-notes-medical"></i> Entry</a>
                                        {{-- @endif --}}
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
    </section>
</div>

@foreach ($listpasien as $pasien)
<div class="modal fade" id="modal-edit{{$pasien->NO_REG}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Asesmen/Tindakan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Asesmen Dokterr</td>
                                    <td> <a href="{{ route('edit_asesmen.dokter', ['NoMr' => $pasien->No_MR, 'noReg' => $pasien->NO_REG])}}" class="btn btn-sm btn-warning"><i class="fas fa fa-edit"></i> Edit</a></td>
                                </tr>
                                {{-- <tr>
                                    <td>Lembar Uji Fungsi</td>
                                    <td> <a href="{{ route('edit.ujifungsi', $pasien->No_MR)}}" class="btn btn-sm btn-warning"><i class="fas fa fa-edit"></i> Edit</a></td>
                                </tr>
                                <tr>
                                    <td>Lembar SPKFR</td>
                                    <td> <a href="{{ route('edit.lembarspkfr', $pasien->No_MR)}}" class="btn btn-sm btn-warning"><i class="fas fa fa-edit"></i> Edit</a></td>
                                </tr> --}}
                                <tr>
                                    <td>Cppt</td>
                                    <td> <a href="{{ route('transaksi_fisio.fisio', ['no_mr' => $pasien->No_MR
                                            ])}}" class="btn btn-sm btn-warning"><i class="fas fa fa-edit"></i> Edit</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="card-footer text-left">
                <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
            </div>

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