@extends('layouts.app')

@section('title', 'Dashboard EMR')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/flag-icon-css/css/flag-icon.min.css') }}">
@endpush

@section('main')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">Order Statistics -
                            <div class="dropdown d-inline">
                                <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">August</a>
                                <ul class="dropdown-menu dropdown-menu-sm">
                                    <li class="dropdown-title">Select Month</li>
                                    <li><a href="#" class="dropdown-item">January</a></li>
                                    <li><a href="#" class="dropdown-item">February</a></li>
                                    <li><a href="#" class="dropdown-item">March</a></li>
                                    <li><a href="#" class="dropdown-item">April</a></li>
                                    <li><a href="#" class="dropdown-item">May</a></li>
                                    <li><a href="#" class="dropdown-item">June</a></li>
                                    <li><a href="#" class="dropdown-item">July</a></li>
                                    <li><a href="#" class="dropdown-item active">August</a></li>
                                    <li><a href="#" class="dropdown-item">September</a></li>
                                    <li><a href="#" class="dropdown-item">October</a></li>
                                    <li><a href="#" class="dropdown-item">November</a></li>
                                    <li><a href="#" class="dropdown-item">December</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">20</div>
                                <div class="card-stats-item-label">Pending</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">12</div>
                                <div class="card-stats-item-label">Shipping</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">23</div>
                                <div class="card-stats-item-label">Completed</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            59
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">Jumlah Pasien Jalur Masuk IGD<code>( Hari ini )</code>
                   
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$countPasienIgdRajal ?? ''}}</div>
                                <div class="card-stats-item-label">Rawat Jalan</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$countPasienIgdRanap ?? ''}}</div>
                                <div class="card-stats-item-label">Rawat Inap</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-user-nurse"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pasien IGD</h4>
                        </div>
                        <div class="card-body">
                            {{$totalPasienIgdToday ?? ''}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">Jumlah Pasien <code>( Hari ini )</code>
                   
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$countPasienRajal ?? ''}}</div>
                                <div class="card-stats-item-label">Rawat Jalan</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$countPasienRanap ?? ''}}</div>
                                <div class="card-stats-item-label">Rawat Inap</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-user-nurse"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pasien</h4>
                        </div>
                        <div class="card-body">
                            {{$totalPasienToday  ?? ''}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">Jumlah Pasien Fisioterapi & SPKFR <code>( Hari ini )</code>
                   
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$countPasienFisioterapi ?? ''}}</div>
                                <div class="card-stats-item-label">Fisioterapi</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$countPasienSPKFR ?? ''}}</div>
                                <div class="card-stats-item-label">SPKFR</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-user-nurse"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pasien</h4>
                        </div>
                        <div class="card-body">
                            {{$totalFisioSkpfr ?? ''}}
                        </div>
                    </div>
                </div>
            </div>
        </div> 
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jumlah Pasien Rawat Jalan By Dokter Hari Ini</h4>
                      
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                <table class="table-striped table" id="table-1">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Dokter</th>
                                        <th>Jumlah Pasien</th>
                                       
                                    </tr>
                                    @foreach ($countPasienByDokter as $hasilCount)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="font-weight-600">{{$hasilCount->Nama_Dokter}}</td>
                                        <td>
                                            <div class="badge badge-info">{{$hasilCount->total}}</div>
                                        </td>
                                        
                                    </tr>
                                        
                                    @endforeach
    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-hero">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-user-nurse"></i>
                            </div>
                            <div class="card-description">Jumlah pasien Ranap Bulan lalu</div>
                        </div>
                        <div class="card-body p-0">
                           <div class="table-responsive table-invoice">
                                <table class="table-striped table" id="table-1">
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Kamar</th>
                                        <th>Jumlah Pasien</th>
                                       
                                    </tr>
                                   
                                    <tr>
                                        <td>1</td>
                                        <td class="font-weight-600">Kelas I</td>
                                        <td>
                                            <div class="badge badge-info">{{$countRanapKls1->total}}</div>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td class="font-weight-600">Kelas II</td>
                                        <td>
                                            <div class="badge badge-info">{{$countRanapKls2->total}}</div>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td class="font-weight-600">Kelas III</td>
                                        <td>
                                            <div class="badge badge-info">{{$countRanapKls3->total}}</div>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td class="font-weight-600">Kelas VIP</td>
                                        <td>
                                            <div class="badge badge-info">{{$countRanapKlsvip->total}}</div>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td class="font-weight-600">Kelas VVIP</td>
                                        <td>
                                            <div class="badge badge-info">{{$countRanapKlsvvip->total}}</div>
                                        </td>
                                        
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
   

        {{-- <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Budget vs Sales</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="158"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card gradient-bottom">
                    <div class="card-header">
                        <h4>Top 5 Products</h4>
                        <div class="card-header-action dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
                            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <li class="dropdown-title">Select Period</li>
                                <li><a href="#" class="dropdown-item">Today</a></li>
                                <li><a href="#" class="dropdown-item">Week</a></li>
                                <li><a href="#" class="dropdown-item active">Month</a></li>
                                <li><a href="#" class="dropdown-item">This Year</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body" id="top-5-scroll">
                        <ul class="list-unstyled list-unstyled-border">
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="{{ asset('img/products/product-3-50.png') }}" alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">86 Sales</div>
                                    </div>
                                    <div class="media-title">oPhone S9 Limited</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="64%"></div>
                                            <div class="budget-price-label">$68,714</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="43%"></div>
                                            <div class="budget-price-label">$38,700</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="{{ asset('img/products/product-4-50.png') }}" alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">67 Sales</div>
                                    </div>
                                    <div class="media-title">iBook Pro 2018</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="84%"></div>
                                            <div class="budget-price-label">$107,133</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="60%"></div>
                                            <div class="budget-price-label">$91,455</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="{{ asset('img/products/product-1-50.png') }}" alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">63 Sales</div>
                                    </div>
                                    <div class="media-title">Headphone Blitz</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="34%"></div>
                                            <div class="budget-price-label">$3,717</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="28%"></div>
                                            <div class="budget-price-label">$2,835</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="{{ asset('img/products/product-3-50.png') }}" alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">28 Sales</div>
                                    </div>
                                    <div class="media-title">oPhone X Lite</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="45%"></div>
                                            <div class="budget-price-label">$13,972</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="30%"></div>
                                            <div class="budget-price-label">$9,660</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="{{ asset('img/products/product-5-50.png') }}" alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">19 Sales</div>
                                    </div>
                                    <div class="media-title">Old Camera</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="35%"></div>
                                            <div class="budget-price-label">$7,391</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="28%"></div>
                                            <div class="budget-price-label">$5,472</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-center pt-3">
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-primary" data-width="20"></div>
                            <div class="budget-price-label">Selling Price</div>
                        </div>
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-danger" data-width="20"></div>
                            <div class="budget-price-label">Budget Price</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Best Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="owl-carousel owl-theme" id="products-carousel">
                            <div>
                                <div class="product-item pb-3">
                                    <div class="product-image">
                                        <img alt="image" src="{{ asset('img/products/product-4-50.png') }}" class="img-fluid">
                                    </div>
                                    <div class="product-details">
                                        <div class="product-name">iBook Pro 2018</div>
                                        <div class="product-review">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="text-muted text-small">67 Sales</div>
                                        <div class="product-cta">
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="product-item">
                                    <div class="product-image">
                                        <img alt="image" src="{{ asset('img/products/product-3-50.png') }}" class="img-fluid">
                                    </div>
                                    <div class="product-details">
                                        <div class="product-name">oPhone S9 Limited</div>
                                        <div class="product-review">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half"></i>
                                        </div>
                                        <div class="text-muted text-small">86 Sales</div>
                                        <div class="product-cta">
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="product-item">
                                    <div class="product-image">
                                        <img alt="image" src="{{ asset('img/products/product-1-50.png') }}" class="img-fluid">
                                    </div>
                                    <div class="product-details">
                                        <div class="product-name">Headphone Blitz</div>
                                        <div class="product-review">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <div class="text-muted text-small">63 Sales</div>
                                        <div class="product-cta">
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Top Countries</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-title mb-2">July</div>
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                    <li class="media">
                                        <span class='flag-icon flag-icon-id'></span>
                                        <div class="media-body ml-3">
                                            <div class="media-title">Indonesia</div>
                                            <div class="text-small text-muted">3,282 <i class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <span class='flag-icon flag-icon-my'></span>
                                        <div class="media-body ml-3">
                                            <div class="media-title">Malaysia</div>
                                            <div class="text-small text-muted">2,976 <i class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <span class='flag-icon flag-icon-us'></span>

                                        <div class="media-body ml-3">
                                            <div class="media-title">United States</div>
                                            <div class="text-small text-muted">1,576 <i class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 mt-sm-0 mt-4">
                                <div class="text-title mb-2">August</div>
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                    <li class="media">
                                        <span class='flag-icon flag-icon-id'></span>
                                        <div class="media-body ml-3">
                                            <div class="media-title">Indonesia</div>
                                            <div class="text-small text-muted">3,486 <i class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <span class='flag-icon flag-icon-ps'></span>

                                        <div class="media-body ml-3">
                                            <div class="media-title">Palestine</div>
                                            <div class="text-small text-muted">3,182 <i class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <span class='flag-icon flag-icon-de'></span>

                                        <div class="media-body ml-3">
                                            <div class="media-title">Germany</div>
                                            <div class="text-small text-muted">2,317 <i class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
        

    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('library/chart.js/dist/Chart.js') }}"></script>
<script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/index.js') }}"></script>
@endpush