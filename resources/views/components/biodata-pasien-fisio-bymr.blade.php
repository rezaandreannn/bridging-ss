<div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">{{ $biodatas->NAMA_PASIEN}} - ({{ $biodatas->NO_MR}})</a>
                            </div>
                            <div class="author-box-job"><b></div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-md-12">
                       
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">NIK</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ $biodatas->HP2}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Tanggal Lahir</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ date('d-m-Y', strtotime($biodatas->TGL_LAHIR))}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Jenis Kelamin</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : @if ($biodatas->JENIS_KELAMIN == 'L')
                                                Laki-Laki
                                                @else
                                                Perempuan
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">No Hp</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ $biodatas->HP1}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Alamat</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ $biodatas->ALAMAT}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Nama Dokter</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ $biodatas->NAMA_DOKTER}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Tanggal Kunjungan</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ date('d-m-Y', strtotime($biodatas->Tanggal))}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-sm-none"></div>
                    </div>