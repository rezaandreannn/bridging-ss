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
                <div class="breadcrumb-item">Fisioterapi Berkas Pasien</div>
            </div>
        </div>

        <div class="section-body">
             
            <div class="card card-primary">
                <form id="filterForm" action="" method="get">
                    <div class="card-header">
                        <h4>Data Pasien Fisioterapi</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="No_mr">No MR</label>
                                    <input type="number" class="form-control" id="no_mr" name="no_mr" value="{{request('no_mr')}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 filter-buttons">
                                <div class="form-group d-flex align-items-end">
                        
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i> Cari</button>
                                    <button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="resetForm()"><i class="fas fa-trash"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
 

            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="spkfr" data-toggle="tab" href="#spkfr2" role="tab" aria-controls="spkfr2" aria-selected="true">Spesialis Rehabilitasi Medik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="fisioterapi" data-toggle="tab" href="#fisioterapi2" role="tab" aria-controls="fisioterapi2" aria-selected="false">Fisioterapi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="alkes" data-toggle="tab" href="#alkes2" role="tab" aria-controls="alkes2" aria-selected="false">Order Alat Kesehatan</a>
                        </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                        <!-- Tab 1 SPKFR -->
                        <div class="tab-pane fade show active" id="spkfr2" role="tabpanel" aria-labelledby="spkfr">
                            <div class="table-responsive">
                                <table class="table-striped table table-bordered" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>NO RM dan Nama</th>
                                            <th>Dokter</th>
                                            <th>Detail Fisioterapi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pasienSpkfr as $pasien)
                                            @php
                                            $tanggal = date('d-m-Y', strtotime($pasien->Tanggal));
                                            @endphp
                                            <tr>
                                                <td width="10%">{{ $tanggal }}</td>
                                                <td width="25%"><span style="color: red">({{ $pasien->No_MR }})</span> - {{ $pasien->Nama_Pasien }}</td>
                                                <td width="15%">{{ $pasien->Nama_Dokter }}</td>
                                                <td width="18%">  
                                                    @if($pasien->Spesialis == 'SPESIALIS REHABILITASI MEDIK' && $berkasfisio->cekAsesmenDokter($pasien->No_Reg) == true )
                                                    <a href="#" 
                                                    data-toggle="modal" 
                                                    data-target="#modal-detail-fisio{{ $pasien->No_Reg }}" 
                                                    data-no-reg="{{ $pasien->No_Reg }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-info"></i> Detail Fisioterapi
                                                 </a>
                                                 
                                                    {{-- <a href="{{ route('berkas.detail_fisioterapi', ['no_reg' => $pasien->No_Reg]) }}" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Detail Fisioterapi</a> --}}
                                           
                                                    @endif
                                                </td>
                                                <td width="20%">
                                                    @if($pasien->Spesialis == 'SPESIALIS REHABILITASI MEDIK' && $berkasfisio->cekAsesmenDokter($pasien->No_Reg) == true )
                                                        <a href="{{ route('berkas.cetakRmFisio', ['no_reg' => $pasien->No_Reg]) }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Asesmen Dokter</a>
                                                        <a href="{{ route('berkas.cppt', ['no_mr' => $pasien->No_MR,'no_reg' => $pasien->No_Reg]) }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Cppt</a>
                                                  
                                                    @endif
                                             
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
            
                        <!-- Tab 2 fisioterapi -->
                        <div class="tab-pane fade" id="fisioterapi2" role="tabpanel" aria-labelledby="fisioterapi">
                            <div class="table-responsive">
                                <table class="table-striped table table-bordered" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>NO RM dan Nama</th>
                                            <th>Dokter</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fisioterapi as $pasien)
                                            @php
                                            $tanggal = date('d-m-Y', strtotime($pasien->Tanggal));
                                            @endphp
                                            <tr>
                                                <td width="5%">{{ $tanggal }}</td>
                                                <td width="15%"><span style="color: red">({{ $pasien->No_MR }})</span> - {{ $pasien->Nama_Pasien }}</td>
                                                <td width="5%">{{ $pasien->Nama_Dokter }}</td>
                                                <td width="20%">
                                       
                                                @if($berkasfisio->cekCpptFisioterapi($pasien->No_Reg) == true)
                                    
                                                    <a href="{{ route('berkas.cppt', ['no_mr' => $pasien->No_MR,'no_reg' => $pasien->No_Reg]) }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Cppt</a>
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                                        
                        <!-- Tab 3 order alkes -->
                                        
                        <div class="tab-pane fade" id="alkes2" role="tabpanel" aria-labelledby="alkes">
                            <div class="table-responsive">
                                <table class="table-striped table table-bordered" id="table-3">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>NO RM dan Nama</th>
                                            <th>No Reg</th>
                                            <th>Dokter</th>
                                            <th>Jenis Alat</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                            <th>Berkas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pasienAlkes as $pasien)
                                        @php
                                        $tanggal = date('d-m-Y', strtotime($pasien->Tanggal));
                                        @endphp
                                        <tr>
                                            <td>{{ $tanggal }}</td>
                                            <td><span style="color: red">({{ $pasien->No_MR }})</span> - {{ $pasien->Nama_Pasien }}</td>
                                            <td>{{ $pasien->No_Reg }}</td>
                                            <td>{{ $pasien->Nama_Dokter }}</td>
                                            <td>{{ $pasien->jenis_alat }}</td>
                                            <td>
                                                @if ($pasien->verif_farmasi != null)
                                                <div class="badge badge-success"><i class="fa-solid fa-check"></i> Sudah diambil</div>
                                                @elseif ($pasien->lingkar_pinggang != null)
                                                <div class="badge badge-info"><i class="fa-solid fa-check"></i> Fisioterapi</div>

                                                @endif
                                            </td>
                                            <td width="20%">                                               
                                            @can('verif alkes')
                                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit-alkes{{$pasien->No_Reg}}"><i class="fa fa-edit"></i> Verif alkes</button> 
                                             
                                           @endcan
                                            </td>
                                            <td width="20%">
                                                <a href="{{ route('rj.alkes', [$pasien->No_Reg])  }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Resep alkes</a>

                                                <a href="{{ route('orderAlkes.Kwitansi', [$pasien->No_Reg])  }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Kwitansi</a>

                                        
                                                @if($pasien->no_registrasi != null)
             
                                                <a href="{{ route('berkas.alat', ['no_reg' => $pasien->No_Reg
                                            ])}}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Cetak Form Alkes</a>
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


        


        {{-- <!-- Modal Structure -->
        <div class="modal fade" id="modal-detail-fisio{{ $pasien->No_Reg }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $pasien->No_Reg }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel{{ $pasien->No_Reg }}">Detail Fisioterapi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Table to display data -->
                        <div id="modal-body-content{{ $pasien->No_Reg }}">
                            <!-- Data will be dynamically inserted here -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> --}}
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
            <form id="formAlkes" action="{{ route('transaksi_fisio.update_alkes_bpjs') }}" method="POST">
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
                                <label>Ukuran Lingkar Pinggang</label>
                                <input type="hidden" name="no_registrasi" value="{{$item->No_Reg}}">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"  name="lingkar_pinggang" value="{{$lingkar_pinggang ?? ''}}" id="lingkar_pinggang" @if ($lingkar_pinggang!=null) readonly @endif>
                                    <div class="input-group-append">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                       
                            </div>
                            <div class="form-group">
                                <label>No SEP</label>
                                {{-- <input type="hidden" name="no_registrasi" value="{{$item->No_Reg}}"> --}}
                                <input type="text" class="form-control"  name="no_sep" value="{{$no_sep ?? ''}}" id="no_sep">
                      
                       
                            </div>
                            <div class="form-group">
                                <label>Biaya</label>
                                {{-- <input type="hidden" name="no_registrasi" value="{{$item->No_Reg}}"> --}}
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"  name="biaya" value="{{$biaya ?? ''}}" id="biaya" placeholder="masukkan hanya angka">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                </div>
                       
                            </div>
                        </div>
                
                </div>

            </div>
            <div class="card-footer text-left">
                <p> <b>Pastikan mengisi dengan benar dan sesuai</b></p>
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Simpan & Aprrove</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endforeach

        <!-- modal edit diagnosa -->
<!-- Modal Structure -->
@foreach ($pasienSpkfr as $pasien)
<div class="modal fade" id="modal-detail-fisio{{ $pasien->No_Reg }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Riwayat Pelayanan Rehabilitasi Medik dan Fisioterapi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Data will be dynamically inserted here -->
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

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('berkas.fisio') }}";
    }
</script>


<script>
    $(document).ready(function() {
        $('a[data-toggle="modal"]').on('click', function() {
            var targetModal = $(this).data('target');
            var noReg = $(this).data('no-reg');

            $.ajax({
                url: 'berkas_fisio/detail_fisioterapi/' + noReg,
                type: 'GET',
                success: function(response) {
                    $(targetModal + ' .modal-body').html(response);
                },
                error: function(xhr) {
                    $(targetModal + ' .modal-body').html('<p>An error occurred while fetching the data.</p>');
                }
            });
        });
    });
</script>



<script>
    $(document).ready(function() {
    // Persist selected tab
    var selectedTab = localStorage.getItem('selectedTab') || '#spkfr2';
    $('#myTab2 a[href="' + selectedTab + '"]').tab('show');

    $('#myTab2 a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr('href');
        localStorage.setItem('selectedTab', target);
        
        // Initialize DataTables for table-3 when the tab is shown
        if (target === '#alkes2' && !$.fn.DataTable.isDataTable('#table-3')) {
            $('#table-3').DataTable();
        }
    });

    // Initialize DataTables
    $('#table-1').DataTable();
    $('#table-2').DataTable();
});
</script>

<script>

    $(document).ready(function() {
        $('#formAlkes input').on('keypress', function(event) {
            if (event.which === 13) {
                event.preventDefault(); // Mencegah pengiriman form
            }
        });
    });
    </script>


@endpush