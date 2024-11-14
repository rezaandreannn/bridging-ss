<div class="card author-box card-primary card-fixed">
    <div class="card-body">
        <div class="author-box-name">
            <a href="#">{{ $biodata->pendaftaran->registerPasien->Nama_Pasien}} - ({{ $biodata->pendaftaran->No_MR}})</a>
        </div>
        <div class="author-box-job"><b></div>
        <div class="author-box-description">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-sm-4">
                            <h6 class="mb-0">Tanggal Lahir</h6>
                        </div>
                        <div class="col-sm-8">
                            : {{ date('d-m-Y', strtotime($biodata->pendaftaran->registerPasien->TGL_LAHIR))}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h6 class="mb-0">Jenis Kelamin</h6>
                        </div>
                        <div class="col-sm-8">
                            : @if ($biodata->pendaftaran->registerPasien->JENIS_KELAMIN == 'L')
                            Laki-Laki
                            @else
                            Perempuan
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h6 class="mb-0">Umur</h6>
                        </div>
                        <div class="col-sm-8">
                            @php
                            use Carbon\Carbon; // Pastikan Carbon diimpor
                            $dateOfBirth = Carbon::parse($biodata->pendaftaran->registerPasien->TGL_LAHIR);
                            $age = $dateOfBirth->age; // Menghitung umur
                             @endphp
                        : {{$age}} tahun
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h6 class="mb-0">Alamat</h6>
                        </div>
                        <div class="col-sm-8">
                            : {{ $biodata->pendaftaran->registerPasien->ALAMAT ?? ''}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h6 class="mb-0">Nama Dokter</h6>
                        </div>
                        <div class="col-sm-8">
                            : {{ $biodata->dokter->Nama_Dokter ?? ''}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-100 d-sm-none"></div>
</div>