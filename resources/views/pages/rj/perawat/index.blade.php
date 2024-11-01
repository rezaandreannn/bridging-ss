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
                <div class="breadcrumb-item active"><a href="{{ route('rj.index') }}">Rawat Jalan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.index') }}">Nurse Record</a></div>
                <div class="breadcrumb-item">Pasien</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <form id="filterForm" action="" method="get">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="kode_dokter">Pilih Dokter</label>
                                    <select class="form-control select2" id="kode_dokter" name="kode_dokter">
                                        <option value="" selected disabled>-- silahkan pillih --</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter->kode_dokter }}" {{ request('kode_dokter') == $dokter->kode_dokter ? 'selected' : '' }}>{{ $dokter->nama_dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 filter-buttons">
                                <div class="form-group d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary mr-2" style="margin-top: 30px;"><i class="fas fa-search"></i> Search</button>
                                    <button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
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
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Periksa</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="text-center" width="5%">
                                        <span class="badge badge-pill badge-success">{{ $item->nomor_antrean }}</span>
                                    </td>
                                    <td>{{ $item->no_mr }}</td>
                                    <td>{{ $item->nama_pasien }}</td>
                                    <td>{{ $item->Alamat }}</td>
                                    <td>
                                        @if($item->FS_STATUS == '')
                                        <div class="badge badge-warning text-white">Perawat</div>
                                        @elseif($item->FS_STATUS == '1')
                                        <div class="badge badge-danger">Dokter</div>
                                        @elseif($item->FS_STATUS == '2')
                                        @if($item->FS_TERAPI == '' or $item->FS_TERAPI == '<p>-</p>')
                                        <div class="badge badge-success">Selesai</div>
                                        @else
                                        <div class="badge badge-info">Farmasi</div>
                                        @endif
                                        @endif
                                    </td>
                                    <td width="40%">
                                        @if($item->FS_STATUS != '')
                                        <a href="{{ route('rj.edit', $item->No_Reg )}}" class="btn btn-sm btn-primary"><i class="fas fa-notes-medical"></i> Edit</a>
                                        @else
                                        <a href="{{ route('rj.add', $item->No_Reg )}}" class="btn btn-sm btn-primary"><i class="fas fa-notes-medical"></i> Entry</a>
                                        @endif

                                        <!-- pasien kontrol -->
                                        @if($item->FS_CARA_PULANG == 2)
                                        @if($item->SPESIALIS == 'SPESIALIS MATA')
                                            <a href="{{ route('polimata.cetakSKDP', [$item->No_Reg, $item->FS_KD_TRS]) }}" class="btn btn-sm btn-info"><i class="fas fa-download"></i> SKDP</a>
                                            <a href="{{ route('kondisiPulang.EditSkdpRS', $item->No_Reg) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i>Edit SKDP</a>
                                        @else
                                            <a href="{{ route('rj.skdp', [
                                            'noReg' => $item->No_Reg,
                                            'kode_transaksi' => $item->FS_KD_TRS
                                            ]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> SKDP</a>
                                        <a href="{{ route('rj.editSKDP', $item->No_Reg) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i>Edit SKDP</a>
                                        @endif
                                        <!-- pasien rujuk luar rs -->
                                        @elseif ($item->FS_CARA_PULANG == 4)
                                        <a href="{{ route('rj.rujukanRS', ['noReg' => $item->No_Reg,'kode_transaksi' => $item->FS_KD_TRS,'id_surat'=> $item->ID_SURAT_RUJUKAN]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Rujukan RS</a>
                                        <!-- pasien dengan rujuk internal -->
                                        @elseif ($item->FS_CARA_PULANG == 6)
                                        <a href="{{ route('rj.rujukanInternal', [ 'noReg' => $item->No_Reg,'kode_transaksi' => $item->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Rujukan Internal</a>
                                        <!-- pasien dikembalikan ke faskes primer -->
                                        @elseif ($item->FS_CARA_PULANG == 7)
                                        <a href="{{ route('rj.faskes', [
                                            'noReg' => $item->No_Reg,
                                            'kode_transaksi' => $item->FS_KD_TRS
                                            ]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Faskes</a>
                                        @elseif ($item->FS_CARA_PULANG == 8)
                                        <a href="{{ route('rj.prb', [
                                            'noReg' => $item->No_Reg,
                                            'kode_transaksi' => $item->FS_KD_TRS
                                            ]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> PRB</a>
                                        @endif

                                        <!-- Radiologi -->
                                        @if($rajalModel->cek_rad($item->No_Reg) == true)
                                        <a href="{{ route('rj.radiologi', [
                                            'noReg' => $item->No_Reg,
                                            'kode_transaksi' => $item->FS_KD_TRS
                                            ]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Radiologi</a>
                                        @endif
                                        <!-- Laboratiorium -->
                                        @if($rajalModel->cek_lab($item->No_Reg) == true)
                                        <a href="{{ route('rj.lab', [
                                            'noReg' => $item->No_Reg,
                                            'kode_transaksi' => $item->FS_KD_TRS
                                            ]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Lab</a>
                                        @endif
                                    <!-- order alat fisioterapi -->
                                        @if($rajalModel->cek_order_alkes($item->No_Reg) == true)
                                        <a href="{{ route('rj.alkes', [$item->No_Reg])  }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-success"><i class="fas fa-download"></i> alkes</a>
                                        @endif
                                        <!-- Resep -->
                                        @if($item->FS_TERAPI != '')
                                            @if($item->SPESIALIS == 'SPESIALIS MATA')
                                            <a href="{{ route('polimata.resep', [$item->No_Reg, $item->FS_KD_TRS])  }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Resep</a>
                                            @else
                                            <a href="{{ route('rj.resep', [$item->No_Reg, $item->FS_KD_TRS])  }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Resep</a>
                                            @endif
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
        window.location.href = "{{ route('rj.index') }}";
    }
</script>

@endpush