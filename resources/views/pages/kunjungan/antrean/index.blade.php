@extends('layouts.app')

@section('title', 'Antrean')

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
            <h1>Antrean</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('antrean.index') }}">Kunjungan</a></div>
                <div class="breadcrumb-item">Antrean</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form id="filterForm" action="" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kode_dokter">Pilih Dokter</label>
                                    <select class="form-control select2" id="kode_dokter" name="kode_dokter">
                                        <option value="" selected disabled>-- silahkan pillih --</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter['kode_dokter'] }}" {{ request('kode_dokter') == $dokter['kode_dokter'] ? 'selected' : '' }}>{{ $dokter['nama_dokter'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal <small>(kosongkan jika tanggal saat ini)</small></label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ request('tanggal') }}">
                                </div>
                            </div>
                            <div class="col-md-4 filter-buttons">
                                <div class="form-group d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary mr-2" style="margin-top: 30px;"><i class="fas fa-filter"></i> Filter</button>
                                    <button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Antrean</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No Antrean</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">Jenis Pasien</th>
                                    <th scope="col">Daftar Dari</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="text-center" width="5%">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="badge badge-success"> {{ $item['nomor_antrean'] }}</div>
                                    </td>
                                    <td>{{ $item['nama_pasien'] }}</td>
                                    <td>{{ $item['no_mr'] }}</td>
                                    <td>{{ $item['no_hp'] }}</td>
                                    <td>{{ $item['jenis_pasien'] }} @if($item['jenis_pasien'] == 'BPJS')
                                        <br>
                                        @foreach($listSEP as $sep)
                                        @if($item['No_Identitas'] != NULL)
                                        @if($sep['noKartu'] == $item['No_Identitas'])
                                        <a href="">{{$sep['noSEP']}}</a>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif</td>
                                    <td>{{ $item['created_by'] }}</td>
                                    <td width="15%">
                                        <button class="btn btn-warning" disabled><i class="fas fa-info-circle"></i></button>
                                        <button class="btn btn-primary" disabled>sync</button>
                                        <!-- <a href="javascript: void(0)" class="btn btn-info"><i class="fas fa-info-circle"></i></a>
                                    <a href="javascript: void(0)" class="btn btn-primary">sync</a> -->
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
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('pendaftaran.index') }}";
    }

</script>
<!-- Page Specific JS File -->
@endpush
