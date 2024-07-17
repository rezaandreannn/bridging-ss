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
                <div class="breadcrumb-item active"><a href="{{ route('layanan.ewsDewasa') }}">Layanan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('layanan.ewsDewasa') }}">EWS</a></div>
                <div class="breadcrumb-item"><a href="{{ route('layanan.ewsDewasa.add') }}">Dewasa</a></div>
                <div class="breadcrumb-item">Add</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header card-success">
                    <h4 class="card-title">Lembar Observasi Early Warning Score</h4>
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
                                    <label>Pernafasan</label>
                                    <input type="text" name="pernafasan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Saturnasi O2</label>
                                    <input type="text" name="saturnasi_o2" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Alat Bantu O2</label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="alat_bantu" value="Ya" id="alat_bantu1" @if(old('alat_bantu', '0' )=='Ya' ) checked @endif>
                                                <label class="form-check-label" for="alat_bantu1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="alat_bantu" value="Tidak Ada" id="alat_bantu2" @if(old('alat_bantu', '0' )=='Tidak Ada' ) checked @endif>
                                                <label class="form-check-label" for="alat_bantu2">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Suhu</label>
                                    <input type="text" name="SUHU" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deyut Jantung</label>
                                    <input type="text" name="SUHU" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tekanan Darah Sistolik</label>
                                    <input type="text" name="SUHU" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kesadaran</label>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="kesadaran" value="Baik" id="kesadaran_baik" @if(old('kesadaran', '0') == 'Baik') checked @endif>
                                                <label class="form-check-label" for="kesadaran_baik">
                                                    A
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="kesadaran" value="Cukup" id="kesadaran_cukup" @if(old('kesadaran', '0') == 'Cukup') checked @endif>
                                                <label class="form-check-label" for="kesadaran_cukup">
                                                    P
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="kesadaran" value="Kurang" id="kesadaran_kurang" @if(old('kesadaran', '0') == 'Kurang') checked @endif>
                                                <label class="form-check-label" for="kesadaran_kurang">
                                                    V
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="kesadaran" value="Sangat Kurang" id="kesadaran_sangat_kurang" @if(old('kesadaran', '0') == 'Sangat Kurang') checked @endif>
                                                <label class="form-check-label" for="kesadaran_sangat_kurang">
                                                    U
                                                </label>
                                            </div>
                                        </div>
                                    </div>
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
                                    <th scope="col">Nafas</th>
                                    <th scope="col">Skor Nafas</th>
                                    <th scope="col">O2</th>
                                    <th scope="col">Skor O2</th>
                                    <th scope="col">Alat Bantu</th>
                                    <th scope="col">Skor Alat Bantu</th>
                                    <th scope="col">Suhu</th>
                                    <th scope="col">Skor Suhu</th>
                                    <th scope="col">Jantung</th>
                                    <th scope="col">SkorJantung</th>
                                    <th scope="col">TD Sistolik</th>
                                    <th scope="col">Skor TD Sistolik</th>
                                    <th scope="col">Kesadaran</th>
                                    <th scope="col">Skor Kesadaran</th>
                                    <th scope="col">Waktu Tindakan</th>
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
                                    <td>0</td>
                                    <td>110</td>
                                    <td>1</td>
                                    <td>118/67</td>
                                    <td>0</td>
                                    <td>A</td>
                                    <td>0</td>
                                    <td>2024-07-15 01:00</td>
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