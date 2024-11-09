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
     .custom-judul{
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
                 max-width:100px;
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
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-ruang">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Ruang</th>
                                    <th scope="col">Nama Ruang</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>123</td>
                                    <td>Operasi</td>
                                    <td> 
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit-ruang">
                                            <i class="fas fa-plus"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-add-ruang">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ruangOperasi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kode Ruang</label>
                                <input type="text" name="kode_ruang" value="{{ old('kode_ruang')}}" class="form-control @error('kode_ruang') is-invalid @enderror">
                            </div>
                            @error('kode_ruang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>  
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Ruang</label>
                                <input type="text" name="nama_ruang" value="{{ old('nama_ruang')}}" class="form-control @error('nama_ruang') is-invalid @enderror">
                            </div>
                            @error('nama_ruang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
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

<div class="modal fade" id="modal-edit-ruang">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ruangOperasi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kode Ruang</label>
                                <input type="text" name="kode_ruang" value="{{ old('kode_ruang')}}" class="form-control @error('kode_ruang') is-invalid @enderror">
                            </div>
                            @error('kode_ruang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>  
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Ruang</label>
                                <input type="text" name="nama_ruang" value="{{ old('nama_ruang')}}" class="form-control @error('nama_ruang') is-invalid @enderror">
                            </div>
                            @error('nama_ruang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
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
function click_jenis_kelamin(selected) {
        // Hide both gender-specific forms initially
        $("#form2, #form3").hide();

        if (selected.value === "Pria") {
            $("#form2").show();
        } else if (selected.value === "Wanita") {
            $("#form3").show();
        }
    }
    // Function to initialize canvas with a background image and enable drawing
    function setupCanvas(canvasId, signatureId, imgSrc) {
        const canvas = document.getElementById(canvasId);
        const ctx = canvas.getContext('2d');
        const signatureData = document.getElementById(signatureId);
        const img = new Image();
        
        img.src = imgSrc; // Path to background image
        img.onload = () => ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        
        let drawing = false;

        // Start drawing on mousedown
        canvas.addEventListener('mousedown', () => {
            drawing = true;
            ctx.beginPath();
        });

        // Draw lines while mouse is moving and button is pressed
        canvas.addEventListener('mousemove', (event) => {
            if (drawing) {
                ctx.lineWidth = 1;
                ctx.lineCap = 'round';
                ctx.strokeStyle = 'red';
                ctx.lineTo(event.offsetX, event.offsetY);
                ctx.stroke();
            }
        });

        // Stop drawing on mouseup, save to textarea
        canvas.addEventListener('mouseup', () => {
            drawing = false;
            ctx.closePath();
            signatureData.value = canvas.toDataURL();
        });

        return { ctx, img, signatureData };
    }

    // Initialize both canvases
    const penandaanPria = setupCanvas('canvasPria', 'signature2', '{{ asset("img/lakii.jpg") }}');
    const penandaanWanita = setupCanvas('canvasWanita', 'signatureData', '{{ asset("img/wanita.jpg") }}');

    // Clear button for Pria canvas
    document.getElementById('clear2').addEventListener('click', () => {
        penandaanPria.ctx.clearRect(0, 0, penandaanPria.ctx.canvas.width, penandaanPria.ctx.canvas.height);
        penandaanPria.ctx.drawImage(penandaanPria.img, 0, 0, penandaanPria.ctx.canvas.width, penandaanPria.ctx.canvas.height);
        penandaanPria.signatureData.value = '';
    });

    // Clear button for Wanita canvas
    document.getElementById('clearCanvas').addEventListener('click', () => {
        penandaanWanita.ctx.clearRect(0, 0, penandaanWanita.ctx.canvas.width, penandaanWanita.ctx.canvas.height);
        penandaanWanita.ctx.drawImage(penandaanWanita.img, 0, 0, penandaanWanita.ctx.canvas.width, penandaanWanita.ctx.canvas.height);
        penandaanWanita.signatureData.value = '';
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