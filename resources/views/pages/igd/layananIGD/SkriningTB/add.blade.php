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
                <div class="breadcrumb-item active"><a href="{{ route('layanan.ewsHamil') }}">Layanan IGD</a></div>
                <div class="breadcrumb-item"><a href="{{ route('layanan.ewsHamil') }}">EWS</a></div>
                <div class="breadcrumb-item"><a href="{{ route('layanan.ewsHamil.add') }}">Ibu Hamil</a></div>
                <div class="breadcrumb-item">Add</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header card-success">
                    <h4 class="card-title">Gejala dan Hasil Pemeriksaan</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal dan jam Terapi </label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" name="tanggal_observasi" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="time" name="jam_observasi" class="form-control" id="jam_keperawatan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Batuk dan demam disertai minimal 1 gejala dari:
                                        Saat Bernafas sesak atau tidak?</label>
                                    <select name="gejala_bernafas" id="" class="form-control select2 @error('gejala_bernafas')  is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih --</option>
                                        <option value="Ya" @if(old('gejala_bernafas')=='Ya' ) selected @endif>Ya</option>
                                        <option value="Tidak" @if(old('gejala_bernafas')=='Tidak' ) selected @endif>Tidak</option>
                                    </select>
                                    @error('gejala_bernafas')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Terasa nyeri dada atau tidak?</label>
                                    <select name="nyeri" id="" class="form-control select2 @error('nyeri')  is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih --</option>
                                        <option value="Ya" @if(old('nyeri')=='Ya' ) selected @endif>Ya</option>
                                        <option value="Tidak" @if(old('nyeri')=='Tidak' ) selected @endif>Tidak</option>
                                    </select>
                                    @error('nyeri')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       
                </div>
                <div class="card-body">
                    <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
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
                                    <th scope="col">Respirasi</th>
                                    <th scope="col">O2</th>
                                    <th scope="col">Inpirasi O2</th>
                                    <th scope="col">Suhu</th>
                                    <th scope="col">Jantung</th>
                                    <th scope="col">TD Sistolik</th>
                                    <th scope="col">TD Diastol</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Frekuensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>19</td>
                                    <td>0</td>
                                    <td>95</td>
                                    <td>1</td>
                                    <td>Ya</td>
                                    <td>2</td>
                                    <td>36,8</td>
                                    <td>2024-07-15 01:00</td>
                                    <td>110</td>
                                </tr>
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
        window.location.href = "{{ route('rm.bymr') }}";
    }
</script>

@endpush