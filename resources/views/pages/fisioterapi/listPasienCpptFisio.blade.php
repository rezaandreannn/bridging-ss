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
            <div class="card card-primary">
                {{-- <form id="filterForm" action="{{ route('transaksi_fisio.fisio') }}" method="get"> --}}
                <form id="filterForm" action="" method="get">
                    <div class="card-header">
                        <h4>Fisioterapi</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="section-title">Pilih Dokter</div>
                                <div class="input-group">
                                    {{-- <select name="no_mr" id="" class="form-control select2">
                                        <option value="" selected disabled>-- Pilih Pasien --</option>
                                        @foreach ($listpasien as $pasien)
                                        <option value="{{ $pasien->NO_MR }}">{{ $pasien->NAMA_PASIEN }}</option>
                                        @endforeach
                                    </select> --}}
                                    <select class="form-control select2" name="kode_dokter" >
                                        <option value="" selected disabled>-- Pilih Pasien --</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter->Kode_Dokter }}" {{ request('kode_dokter') == $dokter->Kode_Dokter ? 'selected' : '' }}>{{ $dokter->Nama_Dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                        <button type="button" class="btn btn-danger" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No Antrian</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">Alat Terapi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Status diterapi</th>
                                    <th scope="col">Aksi</th>
                                    <th scope="col">Order alkes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listpasien as $pasien)
                                <tr>
                                    <td width="5%"> <span class="badge badge-pill badge-success">{{ $pasien->NOMOR }}</span></td>
                                    {{-- <td width="5%">{{ date('Y-m-d', strtotime($pasien->TANGGAL))}}</td> --}}
                                    <td width="15%">{{$pasien->NAMA_PASIEN}}</td>
                                    <td width="10%">{{$pasien->NO_MR}}</td>
                                    <td width="10%">{{$pasien->jenis_fisio}}</td>
                                    <td width="5%">
                                        @if ($fisioterapi->cek_cppt($pasien->NO_REG)==true)
                                        <div class="badge badge-success">sudah diperiksa</div>  
                                        @else
                                        <div class="badge badge-danger">belum diperiksa</div>
                                        @endif
                                    </td>
                                    <td width="5%">
                                        @if ($fisioterapi->cek_status_terapi($pasien->NO_REG)==true)
                                        <div class="badge badge-success"><i class="fa-solid fa-check"></i></div> 
                                        @else
                                        <div class="badge badge-danger"><i class="fa-solid fa-x"></i></div> 
                                        @endif
                                        
                                    </td>
                 
                                    <td width="17%">
                                        <a href="{{ route('transaksi_fisio.fisio', ['no_mr' => $pasien->NO_MR]) }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Open Cppt</a>
                                        @if ($fisioterapi->cek_status_terapi($pasien->NO_REG)==false)
                                        <a href="{{ route('transaksi_fisio.addtindakan', ['no_reg' => $pasien->NO_REG]) }}" onclick="return confirm('Ingin lakukan terapi ?')" class="btn btn-success btn-sm"><i class="fa-solid fa-stethoscope"></i> Lakukan Terapi</a>
                                        @endif
                      
                                    </td>
                                    <td width="15%">
                                        <!-- order alat fisioterapi -->
                                        @if($rajalModel->cek_order_alkes($pasien->NO_REG) == true)
                                        @if($rajalModel->cek_lingkar_pinggang($pasien->NO_REG)->lingkar_pinggang != null)
                                        <div class="badge badge-success"><i class="fa-solid fa-check"></i></div> 
                                        @else
                                        <a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-edit-alkes{{$pasien->NO_REG}}"><i class="fa fa-edit"></i> Edit alkes</a> 
                                        @endif
                                        
                                        <a href="{{ route('rj.alkes', [$pasien->NO_REG])  }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-warning"><i class="fas fa-download"></i> Resep alkes</a>
                                        {{-- <a href="{{ route('rj.alkes', [$pasien->NO_REG])  }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit alkes</a> --}}
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
@foreach ($listpasien as $pasien)
<div class="modal fade" id="modal-edit-alkes{{$pasien->NO_REG}}">">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Rincian Order Alat Kesehatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('transaksi_fisio.update_alkes') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    
                <div class="container">
                                <p><b>Nama : {{$pasien->NAMA_PASIEN}} <br> No MR : {{$pasien->NO_MR}} <br> </b></p>
                            </div>
                        <div class="col-md-12">
                   
                            <div class="form-group">
                                <label>Ukuran Lingkar Pinggang</label>
                                <input type="hidden" name="no_registrasi" value="{{$pasien->NO_REG}}">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"  name="lingkar_pinggang" value="" id="lingkar_pinggang" placeholder="masukkan hanya angka">
                                    <div class="input-group-append">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                       
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

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('list-pasien.index') }}";
    }



</script>

<script>
   
    document.getElementById('lingkar_pinggang').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
</script>



@endpush