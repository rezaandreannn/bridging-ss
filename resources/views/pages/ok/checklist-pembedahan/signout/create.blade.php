@extends('layouts.app')

@section('title', $title ?? '')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title ?? ''}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('operasi.signin.store') }}">Checklist Pembedahan</a></div>
                <div class="breadcrumb-item">Sign Out</div>
            </div>
        </div>
        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            @include('components.biodata-pasien-ok-bynoreg')
            <form action="{{ route('operasi.signout.store') }}" method="POST">
            @csrf
                {{-- Data UMUM --}}
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">SIGN OUT</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="kode_register" value="{{$biodata->pendaftaran->No_Reg}}">
                                <div class="form-group">
                                    <label>Apakah nama tindakan operasi di catat?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="identitas_pasien" id="identitas_pasien1" value="1">
                                        <label class="form-check-label" for="identitas_pasien1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="identitas_pasien" id="identitas_pasien2" value="0" checked>
                                        <label class="form-check-label" for="identitas_pasien2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Apakah instrumen, benda tajam dan kasa lengkap?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="lokasi_operasi_pasien" id="lokasi_operasi_pasien1" value="1">
                                        <label class="form-check-label" for="lokasi_operasi_pasien1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="lokasi_operasi_pasien" id="lokasi_operasi_pasien2" value="0" checked>
                                        <label class="form-check-label" for="lokasi_operasi_pasien2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Penanganan jaringan yang akan dikirimkan ke PA :</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mesin_anestesi_lengkap" id="mesin_anestesi_lengkap1" value="1">
                                        <label class="form-check-label" for="mesin_anestesi_lengkap1">
                                            Memberi identitas jaringan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mesin_anestesi_lengkap" id="mesin_anestesi_lengkap2" value="0" checked>
                                        <label class="form-check-label" for="mesin_anestesi_lengkap2">
                                            Tidak Ada Jaringan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Apakah ada masalah peralatan?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="alergi_pasien" id="alergi_pasien1" value="1">
                                        <label class="form-check-label" for="alergi_pasien1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="alergi_pasien" id="alergi_pasien2" value="0" checked>
                                        <label class="form-check-label" for="alergi_pasien2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Apakah ada yang menjadi perhatian khusus pada pemulihan dan penatalaksanaan pasien?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="riwayat_asma_pasien" id="riwayat_asma_pasien1" value="1">
                                        <label class="form-check-label" for="riwayat_asma_pasien1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="riwayat_asma_pasien" id="riwayat_asma_pasien2" value="0" checked>
                                        <label class="form-check-label" for="riwayat_asma_pasien2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                {{-- Alat --}}
                 {{-- Persiapan Pre Operasi --}}
                 <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Alat</h6>
                    </div>
                    <div class="card-body card-khusus-body">
                        <div class="table-responsive">
                            <table class="table-striped table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Alat</th>
                                        <th scope="col">Hitungan Pertama</th>
                                        <th scope="col">Tambahan</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="alat-table-body">
                                    <tr>
                                        <td>1</td>
                                        <td>Mata Pisau</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="mata_pisau" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="mata_pisau_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="mata_pisau_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jarum</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="jarum" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="jarum_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="jarum_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Kassa Operasi</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="kassa_operasi" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="kassa_operasi_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="kassa_operasi_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Roll Kassa</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="roll_kassa" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="roll_kassa_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="roll_kassa_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Roll Tampon</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="roll_tampon" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="roll_tampon_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="roll_tampon_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Depper</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="depper" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="depper_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="depper_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Pincet</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="pincet" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="pincet_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="pincet_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Gunting</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="gunting" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="gunting_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="gunting_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Klem Arteri</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="klem_arteri" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="klem_arteri_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="klem_arteri_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Klem Jaringan</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="klem_jaringan" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="klem_jaringan_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="klem_jaringan_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Klem Cuci</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="klem_cuci" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="klem_cuci_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="klem_cuci_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Doek Klem</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="doek_klem" class="form-control hitungan-pertama" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="doek_klem_tambah" class="form-control tambahan" placeholder="...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="doek_klem_total" class="form-control total" placeholder="..." readonly>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="text-left">
                    <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
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
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
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

<script>
    // Function untuk menghitung total
    function calculateTotal(row) {
        const hitunganPertama = parseFloat(row.querySelector('.hitungan-pertama').value) || 0;
        const tambahan = parseFloat(row.querySelector('.tambahan').value) || 0;
        const totalInput = row.querySelector('.total');
        totalInput.value = hitunganPertama + tambahan;
    }

    // Event listener untuk setiap input
    document.querySelectorAll('#alat-table-body tr').forEach(row => {
        row.querySelectorAll('.hitungan-pertama, .tambahan').forEach(input => {
            input.addEventListener('input', () => calculateTotal(row));
        });
    });
</script>

@endpush