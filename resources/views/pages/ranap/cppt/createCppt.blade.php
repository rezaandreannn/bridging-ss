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
                <div class="breadcrumb-item active"><a href="{{ route('cppt.index') }}">Catatan Rawat Inap</a></div>
                <div class="breadcrumb-item"><a href="{{ route('cppt.index') }}">CPPT</a></div>
                <div class="breadcrumb-item"><a href="{{ route('cppt.index') }}">Add CPPT</a></div>
            </div>
        </div>

        <div class="section-body">
            <!-- Detail Pasien -->
            @include('components.biodata-pasien-bynoreg')
            <!-- Tutup Detail Pasien -->

            <div class="card author-box card-primary card-fixed">
                <div class="card-body">
                    <div class="author-box-name">
                        <a href="#">Asesmen Awal Medik</a>
                    </div>
                    <div class="author-box-job"><b></div>
                    <div class="author-box-description">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-responsive">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Anamnesa</th>
                                            <td>: {{$cpptByNoReg->FS_ANAMNESA ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Diagnosa</th>
                                            <td>: {{$cpptByNoReg->FS_DIAGNOSA ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Hasil Pemeriksaan Penunjang</th>
                                            <td>: 
                                                {{$cpptByNoReg->FS_HASIL_PEMERIKSAAN_PENUNJANG ?? ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pemeriksaan Fisik</th>
                                            <td>: 
                                                {{$cpptByNoReg->FS_CATATAN_FISIK ?? ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Daftar Masalah</th>
                                            <td>: {{$cpptByNoReg->FS_DAFTAR_MASALAH ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Rencana Tindakan</th>
                                            <td>: {{$cpptByNoReg->FS_TINDAKAN ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Rencana Pemeriksaan Penunjang</th>
                                            <td>: {{$cpptByNoReg->FS_PLANNING ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Waktu Asesmen</th>
                                            <td>: {{$cpptByNoReg->mdd.' / '.$cpptByNoReg->FS_JAM_TRS. ' wib'}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 d-sm-none"></div>
            </div>

            {{-- form --}}
            <div class="card card-primary">
                <div class="card-header card-success card-khusus-header">
                    <h6 class="card-khusus-title">Form Tambah Cppt</h6>
                </div>
                <div class="card-body card-khusus-body">
                    <form action="{{ route('asesmenStore.dokterNew') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"> 
                                    <label>Jenis CPPT</label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_cppt" value="SOAP" id="jenis_cppt">
                                        <label class="form-check-label">
                                            SOAP
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_cppt" value="SBAR" id="jenis_cppt2" checked>
                                        <label class="form-check-label">
                                            SBAR
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_cppt" value="ADIME" id="jenis_cppt23" checked>
                                        <label class="form-check-label">
                                            ADIME
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-1 col-form-label">S</div> <!-- Adjust column width as needed -->
                                        <div class="col-md-11">
                                            <textarea class="form-control @error('diagnosa_klinis') is-invalid  
                                            @enderror" rows="3" name="diagnosa_klinis"  placeholder="Masukan ..."></textarea>
                                            @error('prothesa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-1 col-form-label">O</div> <!-- Adjust column width as needed -->
                                        <div class="col-md-11">
                                            <textarea class="form-control @error('diagnosa_klinis') is-invalid  
                                            @enderror" rows="3" name="diagnosa_klinis"  placeholder="Masukan ..."></textarea>
                                            @error('prothesa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-1 col-form-label">A</div> <!-- Adjust column width as needed -->
                                        <div class="col-md-11">
                                            <textarea class="form-control @error('diagnosa_klinis') is-invalid  
                                            @enderror" rows="3" name="diagnosa_klinis"  placeholder="Masukan ..."></textarea>
                                            @error('prothesa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-1 col-form-label">P</div> <!-- Adjust column width as needed -->
                                        <div class="col-md-11">
                                            <textarea class="form-control @error('diagnosa_klinis') is-invalid  
                                            @enderror" rows="3" name="diagnosa_klinis"  placeholder="Masukan ..."></textarea>
                                            @error('prothesa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-2 col-form-label">Diagnosa Utama</div> <!-- Adjust column width as needed -->
                                        <div class="col-md-10">
                                            <input type="text" name="prothesa" class="form-control @error('prothesa') is-invalid @enderror" value="{{ old('prothesa') }}">
                                            @error('prothesa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-2 col-form-label">Diagnosa Sekunder</div> <!-- Adjust column width as needed -->
                                        <div class="col-md-10">
                                            <input type="text" name="prothesa" class="form-control @error('prothesa') is-invalid @enderror" value="{{ old('prothesa') }}">
                                            @error('prothesa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-2 col-form-label">Kode ICD 10 (bila terdiagnosa TBC)</div> <!-- Adjust column width as needed -->
                                        <div class="col-md-10">
                                            <input type="text" name="prothesa" class="form-control @error('prothesa') is-invalid @enderror" value="{{ old('prothesa') }}">
                                            @error('prothesa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-2 col-form-label">Pemeriksaan Laboratorium</div> <!-- Adjust column width as needed -->
                                        <div class="col-md-10">
                                            <input type="text" name="prothesa" class="form-control @error('prothesa') is-invalid @enderror" value="{{ old('prothesa') }}">
                                            @error('prothesa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-4 col-form-label">Untuk Tanggal</div> <!-- Adjust column width as needed -->
                                        <div class="col-md-8">
                                            <input type="text" name="prothesa" class="form-control @error('prothesa') is-invalid @enderror" value="{{ old('prothesa') }}">
                                            @error('prothesa')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-2 col-form-label">Pemeriksaan Radiologi</div> <!-- Adjust column width as needed -->
                                        <div class="col-md-10">
                                            <input type="text" name="prothesa" class="form-control @error('prothesa') is-invalid @enderror" value="{{ old('prothesa') }}">
                                            @error('prothesa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                
                </div>
                <div class="card-body card-khusus-body">
                    <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                    </div>
                </div>
                </form>
            </div>
            
            <div class="card card-primary">
                <div class="card-header card-success card-khusus-header">
                    <h6 class="card-khusus-title">Shortcut Navigation</h6>
                </div>
                <div class="card">
                    <div class="card-body">
            
                    </div>
                </div>
            </div>
            
            <div class="card card-primary">
                <div class="card-header card-success card-khusus-header">
                    <h6 class="card-khusus-title">List CPPT</h6>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-striped table" id="table-1">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">SOAP/ADIME/SBAR</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">PPA</th>
                                        <th scope="col">Verifikasi DPJP</th>
                             
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>tes</td>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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