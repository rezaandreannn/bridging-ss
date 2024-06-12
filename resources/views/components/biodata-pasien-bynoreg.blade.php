<div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h6 class="mt-1">{{ $biodata->NAMA_PASIEN ?? ''}} - ({{ $biodata->NO_MR ?? ''}})</h6>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <h6 class="mb-0"><b></b></h6>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="media-title">Rekanan :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $biodata->NAMAREKANAN ?? ''}}</div>
                                            </div>
                                        </li>
                        
                                        <li class="media">
                                            <div class="media-title">Jenis Kelamin :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> @if ($biodata->JENIS_KELAMIN == 'L')
                                                    Laki-Laki
                                                    @else
                                                    Perempuan
                                                    @endif  </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Tanggal Lahir :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1">{{ date('d-m-Y', strtotime($biodata->TGL_LAHIR ?? '')) }}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Alamat :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $biodata->ALAMAT ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Nama Dokter :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $biodata->NAMA_DOKTER ?? ''}}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>