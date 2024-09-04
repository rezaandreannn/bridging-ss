@extends('layouts.app')

@section('title', $title ?? '')

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
            <h1>{{ $title ?? ''}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('rj.index') }}">Rawat Jalan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.index') }}">Nurse Record</a></div>
                <div class="breadcrumb-item">Pasien</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <form id="filterForm" action="" method="get">
                    <div class="card-body">
                        <div class="section-title">Pilih Tanggal</div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="tanggal" @if (request('tanggal')==null) value="{{date('Y-m-d')}}" @else value="{{request('tanggal')}}" @endif placeholder="" aria-label="">
                                </div>
                              <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                                <button type="button" class="btn btn-danger" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                              </div>
                            </div>
                          </div>
                    </div>
                </form>
            </div>
   
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">NO RM dan Nama</th>
                                    <th scope="col">No Reg</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Jenis Alat</th>
                                    <th scope="col">Ukuran</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasienAlkes as $pasien)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    {{-- <td>{{date('d-m-Y', strtotime($pasien->Tanggal))}}</td> --}}
                                    <td><span style="color: red">({{ $pasien->No_MR }})</span> - {{ $pasien->Nama_Pasien }}</td>
                                    <td>{{$pasien->No_Reg}}</td>
                                    <td>{{$pasien->Nama_Dokter}}</td>
                                    <td>{{$pasien->jenis_alat}}</td>
                                    <td>{{$pasien->lingkar_pinggang}}</td>
                                    <td>
                                        @if($pasien->verif_by == null)
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-edit-alkes{{$pasien->No_Reg}}"><i class="fa fa-edit"></i> Verif alkes</button> 
                                        @else
                                        <div class="badge badge-success"><i class="fa-solid fa-check"></i> Sudah Diambil</div> 
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

{{-- modal edit rincian alkes --}}
@foreach ($pasienAlkes as $item)
<div class="modal fade" id="modal-edit-alkes{{$item->No_Reg}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Rincian Order Alat Kesehatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAlkes{{$item->No_Reg}}" action="{{ route('transaksi_fisio.update_alkes_farmasi') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="container">
                            <p><b>Nama : {{$item->Nama_Pasien}} <br> No MR : {{$item->No_MR}} <br> </b></p>
                        </div>
                        <div class="col-md-12">
                            @php
                            $lingkar_pinggang=$berkasfisio->cekRincianAlkes($item->No_Reg)->lingkar_pinggang;
                            $no_sep=$berkasfisio->cekRincianAlkes($item->No_Reg)->no_sep;
                            $biaya=$berkasfisio->cekRincianAlkes($item->No_Reg)->biaya;
                            @endphp
                            <div class="form-group">
                                <label>Ukuran/Lingkar Pinggang</label>
                                <input type="hidden" name="no_registrasi" value="{{$item->No_Reg}}">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="lingkar_pinggang" value="{{$lingkar_pinggang ?? ''}}" id="lingkar_pinggang" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ukuran</label>
                                <select name="ukuran" id="ukuran" class="form-control select2" onchange="click_ukuran(this)">
                                    <option value="" selected disabled>Pilih ukuran</option>
                                    @foreach ($masterHargaAlkes as $row)
                                    <option value="{{$row->id}}">{{$row->nama_alat}} - {{ $row->ukuran }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Biaya</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="biaya" value="{{$biaya ?? ''}}" id="biaya" placeholder="Masukkan hanya angka" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <p><b>Pastikan mengisi dengan benar dan sesuai</b></p>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Simpan & Aprrove</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
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
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('rm.harian') }}";
    }
</script>

<script>
    $(document).ready(function() {
        // Initialize Select2 for each modal when it's shown
        $(document).on('shown.bs.modal', '.modal', function (e) {
            const modal = $(e.currentTarget);
            modal.find('.select2').select2({
                placeholder: "Pilih Ukuran",
                allowClear: true
            });
        });

        // Clean up Select2 when the modal is hidden
        $(document).on('hidden.bs.modal', '.modal', function (e) {
            const modal = $(e.currentTarget);
            modal.find('.select2').select2('destroy');
        });
    });
</script>


<script>
    function click_ukuran(selectElement) {
        // Get the selected ukuran value
        var ukuran = $(selectElement).val();
        
        // Find the nearest modal
        var modal = $(selectElement).closest('.modal');
        
        // Find the biaya input field within this modal
        var biayaInput = modal.find('#biaya');

        $.ajax({
            type: "GET",
            url: "{{ route('orderAlkes.verifFarmasi') }}",
            data: {
                ukuran: ukuran
            },
            dataType: 'json',
            success: function(data) {
                // Assuming data.data.harga is the correct field
                var nilai = data.data.harga;

                // Update the biaya field in the correct modal
                biayaInput.val(nilai);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ', status, error);
                alert('An error occurred while fetching the biaya. Please try again.');
            }
        });
    }
</script>

@endpush