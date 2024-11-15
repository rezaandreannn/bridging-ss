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
                    <form id="myForm" action="{{ route('operasi.penandaan.store') }}" method="POST" enctype="multipart/form-data">
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
                            {{-- Gambar Operasi --}}
                            <div class="card" id="{{ $biodata->pendaftaran->registerPasien->JENIS_KELAMIN == 'L' ? 'formPria' : 'formWanita' }}" data-gender="{{ $biodata->pendaftaran->registerPasien->JENIS_KELAMIN }}">
                                <div class="card-body card-khusus-body">
                                    <div class="col-md-12">
                                        <div>
                                            <canvas id="drawingCanvas" width="1000" height="600" style="border:1px solid #000; width:100%; height:auto;"></canvas>
                                            <br />
                                            <button id="undoButton" type="button" class="btn btn-sm btn-primary">Undo Coretan Terakhir</button>
                                            <button id="clearCanvasButton" type="button" class="btn btn-sm btn-primary">Hapus Semua Coretan</button>
                                            <button id="drawButton" type="button" class="btn btn-sm btn-primary">Gambar</button>
                                        </div>
                                        <textarea id="signatureData" name="signatureData" style="display:none;"></textarea>
                                    </div>
                                </div>
                            </div>
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
    const canvas = document.getElementById('drawingCanvas');
    const ctx = canvas.getContext('2d');
    const signatureData = document.getElementById('signatureData');
    let paths = []; // Array to store path history
    let currentPath = []; // Array for the current path being drawn
    let drawing = false; // Drawing status
    let erasing = false; // Erase mode status
    const img = new Image(); // Background image object

    // Set background image based on gender
    const gender = document.getElementById('formPria') ? 'L' : 'P'; // Or read from data-gender
    img.src = gender === 'L' ? '{{ asset('
    img / lakii.jpg ') }}': '{{ asset('
    img / wanita.jpg ') }}'; // Set appropriate image path

    // Load background image
    img.onload = () => {
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    };

    // Function to get scaled mouse coordinates
    function getMousePos(event) {
        const rect = canvas.getBoundingClientRect();
        const scaleX = canvas.width / rect.width; // Scale factor for X
        const scaleY = canvas.height / rect.height; // Scale factor for Y

        return {
            x: (event.clientX - rect.left) * scaleX
            , y: (event.clientY - rect.top) * scaleY
        };
    }

    // Function to redraw all paths
    function drawPaths() {
        ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear canvas
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height); // Redraw background

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

    // Start drawing or erasing
    canvas.addEventListener('mousedown', (event) => {
        drawing = true;
        currentPath = []; // Initialize a new path
        paths.push(currentPath); // Save path in paths array

        const {
            x
            , y
        } = getMousePos(event);
        ctx.beginPath();
        ctx.moveTo(x, y);
        currentPath.push({
            x
            , y
        });
    });

    // Draw or erase on mouse move
    canvas.addEventListener('mousemove', (event) => {
        if (drawing) {
            const {
                x
                , y
            } = getMousePos(event);

            if (erasing) {
                ctx.globalCompositeOperation = 'destination-out'; // Erase mode
                ctx.lineWidth = 10; // Eraser width
            } else {
                ctx.globalCompositeOperation = 'source-over'; // Draw mode
                ctx.lineWidth = 2; // Line width
                ctx.strokeStyle = 'red'; // Line color
            }

            ctx.lineTo(x, y);
            ctx.stroke();

            // Save point in the current path
            currentPath.push({
                x
                , y
            });
        }
    });

    // End drawing
    const endDrawing = () => {
        drawing = false;
        ctx.closePath();
        signatureData.value = canvas.toDataURL(); // Save canvas as data URL
    };

    canvas.addEventListener('mouseup', endDrawing);
    canvas.addEventListener('mouseout', endDrawing); // Stop drawing if cursor leaves canvas

    // Undo last drawing
    document.getElementById('undoButton').addEventListener('click', () => {
        paths.pop(); // Remove last path
        drawPaths(); // Redraw remaining paths
        signatureData.value = canvas.toDataURL(); // Save updated canvas state
    });

    // Clear canvas
    document.getElementById('clearCanvasButton').addEventListener('click', () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear canvas
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height); // Redraw background
        paths = []; // Clear paths array
        signatureData.value = ''; // Reset data URL
    });

    // Enable draw mode
    document.getElementById('drawButton').addEventListener('click', () => {
        erasing = false; // Switch to draw mode
        canvas.style.cursor = 'default'; // Default cursor for drawing
    });

</script>

<script type="text/javascript">
    var sig = $("#signat").signature({
        syncField: "#signature1"
        , syncFormat: "PNG"
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature1").val('');
    });

    var sig2 = $("#signat2").signature({
        syncField: "#signature2"
        , syncFormat: "PNG"
    });
    $('#clear2').click(function(e) {
        e.preventDefault();
        sig2.signature('clear');
        $("#signature2").val('');
    });

</script>

@endpush
