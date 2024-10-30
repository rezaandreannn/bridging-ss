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
                <div class="breadcrumb-item active"><a href="#">Riwayat Rekam Medis</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rm.harian') }}">Berkas Rekam Medis Harian</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <form id="filterForm" action="" method="get">
                    <div class="card-body">
                        <div class="section-title">Pilih Dokter dan Tanggal</div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="col-md-6">

                                    <select class="form-control select2" id="kode_dokter" name="kode_dokter">
                                        <option value="" selected disabled>-- silahkan pillih --</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter->kode_dokter }}" {{ request('kode_dokter') == $dokter->kode_dokter ? 'selected' : '' }}>{{ $dokter->nama_dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              <input type="date" class="form-control" name="tanggal" @if (request('tanggal')==null) value="{{date('Y-m-d')}}" @else value="{{request('tanggal')}}" @endif placeholder="" aria-label="">
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
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPasien as $pasien)   
                                <tr>
                                    <td width="5%">
                                        <div class="badge badge-success">{{$pasien->Nomor}}</div>
                                    </td>
                                    <td width="20%">{{$pasien->Nama_Pasien}}</td>
                                    <td width="25%">{{$pasien->Alamat}}</td>
                                    <td width="10%">
                                        @if ($pasien->FS_STATUS=='')
                                        <div class="badge badge-warning">Perawat</div>
                                        @elseif ($pasien->FS_STATUS=='1')
                                        <div class="badge badge-danger">Dokter</div>
                                        @elseif ($pasien->FS_STATUS=='2')
                                            @if ($pasien->FS_TERAPI=='')
                                            <div class="badge badge-success">Selesai</div>
                                            @else
                                            <div class="badge badge-info">Farmasi</div>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($pasien->SPESIALIS == 'SPESIALIS REHABILITASI MEDIK')
                                        <a href="{{ route('berkas.cetakRmFisio', ['no_reg' => $pasien->No_Reg]) }}" class="btn btn-sm btn-success" target="_blank"><i class="fas fa-download"></i> RM SPKFR</a>
                                        @elseif ($pasien->SPESIALIS == 'FISIOTERAPI')
                                        <a href="{{ route('cppt.cetakCpptRiwayat', ['no_reg' => $pasien->No_Reg,'no_mr' => $pasien->No_MR]) }}" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-download"></i>Lihat CPPT</a>
                                        
                                        @else
                                        {{-- RM Poli Mata --}}
                                        @if ($pasien->SPESIALIS == 'SPESIALIS MATA')
                                        <a href="{{ route('polimata.cetakRM', [$pasien->No_Reg]) }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> RM</a>
                                        @else
                                        <a href="{{ route('rj.rmDokter', ['noReg' => $pasien->No_Reg, 'noMR'=> $pasien->No_MR]) }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> RM</a>
                                        @endif
                                        

                                        
                                            {{-- button untuk  edit riwayat 1x24 jam --}}
                                            @if($pasien->Tanggal>=$tglKemarin)
                                                @if($pasien->FS_STATUS != '')
                                                <a href="{{ route('rj.edit', ['noReg' =>$pasien->No_Reg]) }}" class="btn btn-sm btn-warning"><i class="fas fa-download"></i> Edit Perawat</a>
                                                @else
                                                <a href="{{ route('rj.add', ['noReg' =>$pasien->No_Reg]) }}" class="btn btn-sm btn-warning"><i class="fas fa-download"></i> Edit Perawat</a>
                                                @endif
                                                @if($pasien->Kode_Dokter == $userLogin)
                                                <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-download"></i> Edit Dokter</a>
                                                @endif
                                            @endif
                                            {{-- button untuk  edit riwayat 1x24 jam --}}


                                            {{-- cara pulang untuk berkas surat --}}
                                            @if($pasien->FS_CARA_PULANG == '1')
                                            <a href="{{ route('rj.prb', ['noReg' => $pasien->No_Reg,'kode_transaksi' => $pasien->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> RB</a>
                                            @endif

                                            @if($pasien->FS_CARA_PULANG == '2')
                                                @if($pasien->SPESIALIS == 'SPESIALIS MATA')
                                                <a href="{{ route('polimata.cetakSKDP', [$pasien->No_Reg, $pasien->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> SKDP</a>
                                                @else
                                                <a href="{{ route('rj.skdp', ['noReg' => $pasien->No_Reg,'kode_transaksi' => $pasien->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> SKDP</a>
                                                @endif
                                            @endif
                                            @if($pasien->FS_CARA_PULANG == '3')
                                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Rawat Inap</a>
                                            @endif
                                            @if($pasien->FS_CARA_PULANG == '4')
                                                @if($pasien->SPESIALIS == 'SPESIALIS MATA')
                                                    <a href="{{ route('polimata.cetakRujukanRS', [$pasien->No_Reg, $pasien->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Rujukan RS</a>
                                                @else
                                                    <a href="{{ route('rj.rujukanRS', ['noReg' => $pasien->No_Reg,'kode_transaksi' => $pasien->FS_KD_TRS,'id_surat'=> $pasien->ID_SURAT_RUJUKAN]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Rujukan RS</a>
                                                @endif
                                            @endif
                                            @if($pasien->FS_CARA_PULANG == '5')
                                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-download"></i> PRB/Prolanis</a>
                                            @endif
                                            @if($pasien->FS_CARA_PULANG == '6')
                                                @if($pasien->SPESIALIS == 'SPESIALIS MATA')
                                                    <a href="{{ route('polimata.cetakRujukanInternal', [$pasien->No_Reg, $pasien->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Rujukan Internal</a>
                                                @else
                                                    <a href="{{ route('rj.rujukanInternal', ['noReg' => $pasien->No_Reg,'kode_transaksi' => $pasien->FS_KD_TRS,'id_surat'=> $pasien->ID_SURAT_RUJUKAN]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Rujukan Internal</a>
                                                @endif
                                            @endif
                                            @if($pasien->FS_CARA_PULANG == '7')
                                            <a href="{{ route('rj.faskes', ['noReg' => $pasien->No_Reg,'kode_transaksi' => $pasien->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Faskes</a>
                                            @endif
                                            @if($pasien->FS_CARA_PULANG == '8')
                                            <a href="{{ route('rj.prb', ['noReg' => $pasien->No_Reg,'kode_transaksi' => $pasien->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> PRB</a>
                                            @endif

                                            {{-- Resep --}}
                                            @if($pasien->FS_TERAPI != '')
                                                @if($pasien->SPESIALIS == 'SPESIALIS MATA')
                                                <a href="{{ route('polimata.resep', [$pasien->No_Reg, $pasien->FS_KD_TRS])  }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Resep</a>
                                                @else
                                                <a href="{{ route('rj.resep', [$pasien->No_Reg, $pasien->FS_KD_TRS])  }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Resep</a>
                                                @endif
                                            @endif

                                            {{-- hasil echo --}}
                                            @if($pasien->HASIL_ECHO != '')
                                            <a href="{{ route('rj.hasilEcho', ['noReg' => $pasien->No_Reg,'kode_transaksi' => $pasien->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Hasil Echo</a>
                                            @endif

                                        {{-- cek lab dan radiologi --}}
                                            @if($rekamMedisModel->cekLab($pasien->No_Reg) == true)
                                            <a href="{{ route('rj.lab', ['noReg' => $pasien->No_Reg,'kode_transaksi' => $pasien->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Lab</a>
                                            @endif

                                            {{-- hasil radiologi --}}
                                            @if($rekamMedisModel->cekRadiologi($pasien->No_Reg) == true)
                                            <a href="{{ route('rj.radiologi', ['noReg' => $pasien->No_Reg,'kode_transaksi' => $pasien->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Radiologi</a>
                                            @endif

                                            {{-- batas if spesialis rehab medik --}}
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
        window.location.href = "{{ route('rm.harian') }}";
    }
</script>

@endpush