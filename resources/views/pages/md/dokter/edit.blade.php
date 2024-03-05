@extends('layouts.app')

@section('title', 'Edit')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item">Advanced Forms</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"></h2>
            <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p>

            <form action="" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Input Text</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kode Dokter</label>
                                    <input type="text" class="form-control" name="kode_dokter" value="{{ $dokter['kode_dokter'] }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama Dokter</label>
                                    <input type="text" class="form-control" name="nama_dokter" value="{{ $dokter['nama_dokter'] }}">
                                </div>
                                <button type="submit" class="btn btn-primary">submit</button>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <!-- <div class="card">
                        <div class="card-header">
                            <h4>Select</h4>
                        </div>
                        <div class="card-body">
                            <div class="section-title mt-0">Default</div>
                            <div class="form-group">
                                <label>Default Select</label>
                                <select class="form-control">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                            </div>
                            <div class="section-title">Select 2</div>
                            <div class="form-group">
                                <label>Select2</label>
                                <select class="form-control select2">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select2 Multiple</label>
                                <select class="form-control select2" multiple="">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                    <option>Option 4</option>
                                    <option>Option 5</option>
                                    <option>Option 6</option>
                                </select>
                            </div>
                            <div class="section-title">jQuery Selectric</div>
                            <div class="form-group">
                                <label>jQuery Selectric</label>
                                <select class="form-control selectric">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                    <option>Option 4</option>
                                    <option>Option 5</option>
                                    <option>Option 6</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>jQuery Selectric Multiple</label>
                                <select class="form-control selectric" multiple="">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                    <option>Option 4</option>
                                    <option>Option 5</option>
                                    <option>Option 6</option>
                                </select>
                            </div>
                            <div class="section-title">Select Group Button</div>
                            <div class="form-group">
                                <label class="form-label">Size</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="50" class="selectgroup-input" checked="">
                                        <span class="selectgroup-button">S</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="100" class="selectgroup-input">
                                        <span class="selectgroup-button">M</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="150" class="selectgroup-input">
                                        <span class="selectgroup-button">L</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="200" class="selectgroup-input">
                                        <span class="selectgroup-button">XL</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Icons input</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="transportation" value="2" class="selectgroup-input">
                                        <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-mobile"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="transportation" value="1" class="selectgroup-input" checked="">
                                        <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-tablet"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="transportation" value="6" class="selectgroup-input">
                                        <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-laptop"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="transportation" value="6" class="selectgroup-input">
                                        <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-times"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Icon input</label>
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                                        <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-sun"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="2" class="selectgroup-input">
                                        <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-moon"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="3" class="selectgroup-input">
                                        <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-cloud-rain"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="4" class="selectgroup-input">
                                        <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-cloud"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Your skills</label>
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="value" value="HTML" class="selectgroup-input" checked="">
                                        <span class="selectgroup-button">HTML</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="value" value="CSS" class="selectgroup-input">
                                        <span class="selectgroup-button">CSS</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="value" value="PHP" class="selectgroup-input">
                                        <span class="selectgroup-button">PHP</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="value" value="JavaScript" class="selectgroup-input">
                                        <span class="selectgroup-button">JavaScript</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
                                        <span class="selectgroup-button">Ruby</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
                                        <span class="selectgroup-button">Ruby</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="value" value="C++" class="selectgroup-input">
                                        <span class="selectgroup-button">C++</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    </div>

                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush