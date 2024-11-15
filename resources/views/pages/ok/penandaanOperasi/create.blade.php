@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<!-- Select -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('ttd/css/jquery.signature.css') }}">

<style>
    .kbw-signature {
        width: 100%;
        height: 250px;
    }

    .eye-image {
        max-width: 100%;
    }

    .custom-judul {
        font-size: 18px;
        padding-left: 20px;
        color: #6777ef;
        margin-bottom: 0;
        width: 100%;
    }

    .no-margin {
        margin: 0;
    }

    .no-padding {
        padding: 0;
    }

    .align-items-center {
        display: flex;
        align-items: center;
        margin: 0;
    }

    @media (max-width: 768px) {
        .text-right-mobile {
            text-align: right;
            font-size: 6px;
        }

        .text-left-mobile {
            text-align: left;
            font-size: 6px;
        }

        .eye-image {
            max-width: 100px;
        }

        .my-mobile {
            margin-top: 2rem !important;
            margin-bottom: 1rem !important;
        }

        .kbw-signature {
            width: 100%;
            height: 250px;
        }
    }

    .my-0 {
        margin-top: -10px !important;
        margin-bottom: 0 !important;
    }

    .my-1 {
        margin-bottom: -30px !important;
    }

</style>
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('list-pasien.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Penandaan Operasi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no reg -->
                    @include('components.biodata-pasien-ok-bynoreg')
                    <form id="myForm" action="{{ route('operasi.penandaan.store') }}" method="POST">
                        @csrf
                        <div class="card mb-3">
                            <div class="card-header card-khusus-header">
                                <h6 class="card-khusus-title">Penandaan Operasi @if ($biodata->pendaftaran->registerPasien->JENIS_KELAMIN == 'L')
                                    Laki-Laki
                                    @else
                                    Perempuan
                                    @endif</h6>
                            </div>
                            <!-- include form -->
                            <div class="card-body card-khusus-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="date" name="tanggal" value="{{ old('tanggal', $biodata->tanggal ?? '')}}" class="form-control @error('tanggal') is-invalid @enderror" disabled>
                                        </div>
                                        @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-block">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="kondisi" class="form-control select2 @error('jenis_kelamin')  is-invalid @enderror" onchange="click_jenis_kelamin(this)">
                                                <option value="">--Pilih Jenis Kelamin--</option>
                                                <option value="Pria" @if(old('jenis_kelamin')=='Pria' ) selected @endif>Pria</option>
                                                <option value="Wanita" @if(old('jenis_kelamin')=='Wanita' ) selected @endif>Wanita</option>
                                            </select>
                                            @error('jenis_kelamin')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Tindakan</label>
                                            <input type="text" name="nama_tindakan" value="{{ old('nama_tindakan', $biodata->nama_tindakan ?? '')}}" class="form-control @error('nama_tindakan') is-invalid @enderror" readonly>
                                        </div>
                                        @error('jenis_operasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @if($biodata->pendaftaran->registerPasien->JENIS_KELAMIN == 'L')
                            <!-- Pria (Male) Form -->
                            <div class="card" id="formPria">
                                <div class="card-body card-khusus-body">
                                    <div class="col-md-12">
                                        <div>
                                            <canvas id="drawingCanvas" width="1000" height="600" style="border:1px solid #000; width:100%; height:auto;"></canvas>
                                            <br />
                                            <button id="undoButton" type="button">Undo Coretan Terakhir</button>
                                            <button id="clearCanvasButton" type="button">Hapus Semua Coretan</button>
                                            <button id="drawButton" type="button">Gambar</button>
                                        </div>
                                        <textarea id="signatureData" name="signatureData" style="display:none;"></textarea>
                                    </div>
                                </div>
                            </div>
                            @elseif($biodata->pendaftaran->registerPasien->JENIS_KELAMIN == 'P')
                                <!-- Wanita (Female) Form -->
                                <div class="card" id="formWanita">
                                    <div class="card-body card-khusus-body">
                                        <div class="col-md-12">
                                            <div>
                                                <canvas id="drawingCanvas" width="1000" height="600" style="border:1px solid #000; width:100%; height:auto;"></canvas>
                                                <br />
                                                <button id="undoButton" type="button">Undo Coretan Terakhir</button>
                                                <button id="clearCanvasButton" type="button">Hapus Semua Coretan</button>
                                                <button id="drawButton" type="button">Gambar</button>
                                            </div>
                                            <textarea id="signatureData" name="signatureData" style="display:none;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.signature.min.js') }}"></script>
{{-- <script src="{{ asset('ttd/js/signature_pad.min.js') }}"></script> --}}

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#myForm input').on('keypress', function(event) {
            if (event.which === 13) {
                event.preventDefault(); // Mencegah pengiriman form
            }
        });
    });

</script>
<script>
   // Variabel untuk canvas, context, dan histori coretan
    const canvas = document.getElementById('drawingCanvas');
    const ctx = canvas.getContext('2d');
    const signatureData = document.getElementById('signatureData');
    let paths = [];           // Array untuk menyimpan histori coretan
    let currentPath = [];     // Array untuk coretan yang sedang dibuat
    let drawing = false;      // Status menggambar
    const img = new Image();  // Objek gambar latar (jika diperlukan)

    // Mengatur gambar latar (jika ada)
    img.src = '{{ asset('img/lakii.jpg') }}';  // Ganti dengan URL gambar latar Anda
    img.onload = () => {
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    };

    // Fungsi untuk menggambar ulang semua coretan dari histori
    function drawPaths() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);  // Bersihkan canvas
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);  // Gambar ulang gambar latar

        paths.forEach(path => {
            ctx.beginPath();
            path.forEach((point, index) => {
                if (index === 0) {
                    ctx.moveTo(point.x, point.y);
                } else {
                    ctx.lineTo(point.x, point.y);
                }
            });
            ctx.stroke();
        });
    }

    // Event saat mulai menggambar atau menghapus
    canvas.addEventListener('mousedown', (event) => {
        drawing = true;
        currentPath = [];      // Inisialisasi path baru
        paths.push(currentPath); // Simpan path di array paths

        ctx.beginPath();
        ctx.moveTo(event.offsetX, event.offsetY);
        currentPath.push({ x: event.offsetX, y: event.offsetY });
    });

    // Event saat menggambar atau menghapus
    canvas.addEventListener('mousemove', (event) => {
        if (drawing) {
            if (erasing) {
                ctx.globalCompositeOperation = 'destination-out'; // Mode penghapus
                ctx.lineWidth = 10;  // Lebar penghapus
            } else {
                ctx.globalCompositeOperation = 'source-over'; // Mode menggambar biasa
                ctx.lineWidth = 2;   // Lebar garis
                ctx.strokeStyle = 'red'; // Warna coretan
            }

            ctx.lineTo(event.offsetX, event.offsetY);
            ctx.stroke();
            
            // Simpan titik di path saat ini
            currentPath.push({ x: event.offsetX, y: event.offsetY });
        }
    });

    // Event saat selesai menggambar atau menghapus
    canvas.addEventListener('mouseup', () => {
        drawing = false;
        ctx.closePath();

        // Simpan canvas dalam bentuk data URL
        signatureData.value = canvas.toDataURL();
    });

    // Tombol untuk menghapus coretan terakhir (undo)
    document.getElementById('undoButton').addEventListener('click', () => {
        paths.pop(); // Hapus path terakhir dari array paths
        drawPaths(); // Gambar ulang semua paths yang tersisa
        signatureData.value = canvas.toDataURL(); // Simpan hasil baru ke textarea
    });

    // Tombol untuk menghapus semua coretan
    document.getElementById('clearCanvasButton').addEventListener('click', () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);  // Bersihkan canvas
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);  // Gambar ulang gambar latar
        paths = [];  // Kosongkan array paths
        signatureData.value = '';  // Reset data URL pada textarea
    });

    // Tombol untuk mengaktifkan mode menggambar
    document.getElementById('drawButton').addEventListener('click', () => {
        erasing = false; // Aktifkan mode menggambar biasa
    });
</script>

<script type="text/javascript">

    var sig = $("#signat").signature({
        syncField: "#signature1",
        syncFormat: "PNG"
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature1").val('');
    });

    var sig2 = $("#signat2").signature({
        syncField: "#signature2",
        syncFormat: "PNG"
    });
    $('#clear2').click(function(e) {
        e.preventDefault();
        sig2.signature('clear');
        $("#signature2").val('');
    });
</script>

@endpush
