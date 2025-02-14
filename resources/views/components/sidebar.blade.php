<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">EMR V2 (DEV)</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">EMR</a>
        </div>
        <ul class="sidebar-menu">
            @can('dashboard')
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-dashboard"></i> <span>Dashboard</span></a></li>

            {{-- booking operasi --}}
            {{-- @can('booking operasi')
            <li class="{{ Request::is('booking-operasi*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('operasi.booking.index') }}"><i class="fas fa-book"></i> <span>Booking Operasi</span></a></li>
            @endcan --}}
            {{-- booking operasi --}}
            @endcan
            @can('riwayat medis')
            <li class="nav-item dropdown {{ Request::is('riwayat-medis*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-notes-medical"></i> <span>Riwayat Medis</span></a>
                @can('Riwayat Berkas Operasi')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('riwayat-medis/operasi*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('berkas-operasi.index') }}">Berkas Operasi</a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan

            <!-- <li class="menu-header">RSUMM</li> -->
            @can('master data')
            <li class="menu-header">Master Data</li>
            <li class="nav-item dropdown {{ Request::is('md*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
                @can('master data pasien')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('md/patient*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('patient.index') }}">Pasien</a>
                    </li>
                </ul>
                @endcan
                @can('master data dokter')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('md/dokter*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dokter.index') }}">Dokter</a>
                    </li>
                </ul>
                @endcan
                @can('master data organisasi')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('md/organization*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('organization.index') }}">Organisasi</a>
                    </li>
                </ul>
                @endcan
                @can('master data lokasi')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('md/location*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('location.index') }}">Lokasi</a>
                    </li>
                </ul>
                @endcan
                @can('master data icd 10')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('md/icd10*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('icd10.index') }}">ICD 10</a>
                    </li>
                </ul>
                @endcan
                @can('master data jenis fisio')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('md/jenisFisio*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('jenisFisio.index') }}">Jenis Fisio</a>
                    </li>
                </ul>
                @endcan
                @can('master data alat kesehatan')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('md/farmasi*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('masterData.index') }}">Alat Kesehatan</a>
                    </li>
                </ul>
                @endcan
                @can('master data riwayat penyakit')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pm/master_data/penyakit_sekarang/list*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('penyakitSekarang.index') }}">Riwayat Penyakit</a>
                    </li>
                </ul>
                @endcan
                @can('tanda tangan dokter')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('md/ttd-dokter*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('ttd-dokter.index') }}">Ttd Dokter</a>
                    </li>
                </ul>
                @endcan
                @can('tanda tangan perawat')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('md/ttd-perawat*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('ttd-perawat.index') }}">Ttd Perawat</a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan
            @can('kunjungan')
            <li class="nav-item dropdown {{ Request::is('kj*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-hand-holding-medical"></i> <span>Kunjungan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('kj/pendaftaran*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pendaftaran.index') }}">Pendaftaran</a>
                    </li>
                    <li class="{{ Request::is('kj/antrean*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('antrean.index') }}">Antrean</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('bridge')
            <li class="menu-header">Bridge</li>
            <li class="nav-item dropdown {{ Request::is('ss*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clinic-medical"></i> <span>Satu Sehat</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('ss/encounter') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('resource.index') }}">Encounter</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('medis')
            <li class="menu-header">Poliklinik dan Rawat Jalan</li>
            <li class="nav-item dropdown {{ Request::is('fisioterapi/dokter*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Medis</span></a>
                @can('medis rajal')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('fisioterapi/asesmen_pasien') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rj.dokter') }}">pemeriksaan rawat jalan</a>
                    </li>
                </ul>
                @endcan
                @can('medis fisioterapi')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('fisioterapi/dokter/list_pasiens*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('list_pasiens.dokter') }}">Pemeriksaan Fisioterapi</a>
                    </li>
                </ul>
                @endcan
                @can('medis fisioterapi')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('fisioterapi/dokter/riwayat_pasien*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('riwayatFisio.dokter') }}">Pemeriksaan Fisio by tgl</a>
                    </li>
                </ul>
                @endcan
                @can('history pemeriksaan')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('fisioterapi/dokter/riwayat_pemeriksaan_pasien*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('riwayatPemeriksaanPasien.dokter') }}">History pemeriksaan</a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan

            @can('poliklinik')
            <li class="menu-header">Poliklinik</li>
            @can('poliklinik mata')
            <li class="nav-item dropdown {{ Request::is('pm/polimata/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-eye"></i> <span>Poli Mata</span></a>
                @can('poliklinik mata assesmen perawat')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pm/polimata/perawat*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('poliMata.index') }}">Assesmen Perawat</a>
                    </li>
                </ul>
                @endcan
                @can('poliklinik mata assesmen perawat2')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pm/polimata/Assesmen_keperawatan2*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('poliMata.index2') }}">Assesmen Lama</a>
                    </li>
                </ul>
                @endcan
                @can('poliklinik mata refraksi optisi')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pm/polimata/refraksi*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('poliMata.refraksi') }}">Refraksi Optisi</a>
                    </li>
                </ul>
                @endcan
                @can('poliklinik mata refraksi optisi2')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pm/polimata/refraksi2*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('poliMata.refraksi') }}">Refraksi Optisi Lama</a>
                    </li>
                </ul>
                @endcan
                @can('poliklinik mata assesmen dokter')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pm/polimata/dokter*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('poliMata.indexDokter') }}">Assesmen Dokter</a>
                    </li>
                </ul>
                @endcan
                @can('poliklinik mata assesmen dokter2')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pm/polimata/dokter2*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('poliMata.indexDokter2') }}">Assesmen Dokter Lama</a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan
            @can('berkas poliklinik mata')
            <li class="nav-item dropdown {{ Request::is('pm/berkasPoliMata/riwayatRekamMedis*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-text"></i> <span>Berkas</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pm/berkasPoliMata/riwayatRekamMedis*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('poliMata.rekamMedis') }}">RM Poli Mata</a>
                    </li>
                </ul>
            </li>
            @endcan
            @endcan
            @can('nurse record')
            <li class="menu-header">Rawat Jalan</li>
            <li class="nav-item dropdown {{ Request::is('rj*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-nurse"></i> <span>Catatan Perawat</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('rj*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rj.index') }}">Pasien</a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('fisioterapi')
            <li class="menu-header">Fisioterapi</li>
            <!-- <li class="nav-item dropdown  {{ Request::is('fisioterapi/master_data/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('fisioterapi/master_data/diagnosis_medis/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('diagnosisMedis.index')}}">Diagnosis Medis</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('fisioterapi/master_data/diagnosis_fungsi/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('diagnosisFungsi.index')}}">Diagnosis Fungsi</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('fisioterapi/master_data/kesimpulan/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('kesimpulan.index')}}">Kesimpulan</a>
                    </li>
                </ul>
        
            </li> -->

            <li class="nav-item dropdown {{ Request::is('fisioterapi/perawat*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical">
                    </i> <span>Fisioterapi</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('fisioterapi/perawat/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('list-pasien.index') }}">CPPT Fisioterapi</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('fisioterapi/perawat/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('informed_concent.index') }}">Informed Concent</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('berkas fisio')
            @can('claim bpjs')
            <li class="menu-header">Fisioterapi</li>
            @endcan
            <li class="nav-item dropdown {{ Request::is('berkas/berkas_fisio*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Berkas</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('berkas/berkas_fisio*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('berkas.fisio')}}">Berkas Fisioterapi</a>
                    </li>
                </ul>
                <!-- <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="#">Informed Concent</a>
                    </li>
                </ul> -->
            </li>
            @endcan

            @can('catatan rawat inap')
            <li class="menu-header">Rawat Inap</li>
            <li class="nav-item dropdown  {{ Request::is('ri/cppt/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span> Catatan Rawat Inap</span></a>
                @can('cppt')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('ri/cppt/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cppt.index')}}">CPPT</a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan

            @can('ok')
            <li class="menu-header">Modul Operasi / OK</li>
            {{-- Booking Operasi --}}
            @can('booking operasi')
            <li class="{{ Request::is('booking-operasi*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('operasi.booking.index') }}"><i class="fas fa-id-card-clip"></i> <span>Booking Operasi</span></a></li>
            @endcan

            @can('list pasien')
            <li class="{{ Request::is('ibs/list-pasien*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('operasi.list-pasien.index')}}"><i class="fas fa-list-alt"></i><span>List Pasien</span></a></li>
            @endcan

            {{-- Penandaan Operasi --}}
            @can('penandaan operasi')
            <li class="{{ Request::is('penandaan/penandaan-operasi*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('operasi.penandaan.index')}}"><i class="fas fa-file-medical"></i> <span>Penandaan Operasi</span></a></li>
            @endcan

            {{-- Pasca Bedah --}}
            @can('perencanaan pasca bedah')
            <li class="{{ Request::is('operasi/pasca-bedah*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pascabedah.perencanaan-pascabedah.index')}}"><i class="fas fa-file-medical"></i> <span>Pasca Bedah</span></a></li>
            @endcan

            {{-- IBS Operasi --}}
            @can('ibs')
            @can('jadwal operasi')
            <li class="{{ Request::is('ibs/jadwal-operasi*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('operasi.jadwal.index')}}"><i class="fas fa-stethoscope"></i> <span>Jadwal</span></a></li>
            @endcan
            @can('ruang operasi')
            <li class="{{ Request::is('ibs/ruang-operasi*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('operasi.ruang.index')}}"><i class="fas fa-hospital-symbol"></i> <span>Master Ruangan</span></a></li>
            @endcan

            @can('checklist pembedahan')
            <li class="nav-item dropdown  {{ Request::is('check-list/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-house-medical-circle-check"></i> <span> CheckList Pembedahan</span></a>
                @can('checklist sign in')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('check-list/signin*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('operasi.signin.index')}}">Checklist Sign In</a>
                    </li>
                </ul>
                @endcan
                @can('checklist time out')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('check-list/timeout*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('operasi.signin.index')}}">Checklist Time Out</a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan
            {{-- Berkas Operasi --}}

            <li class="{{ Request::is('ibs/doctor*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('operasi.doctor.index')}}"><i class="fa-solid fa-user-doctor"></i> <span>Dokter Bedah</span></a></li>

            @can('template operasi')
            {{-- <li class="{{ Request::is('ibs/template-operasi/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('operasi.template.index')}}"><i class="fas fa-book-medical"></i> <span>Template Operasi</span></a></li> --}}
            @endcan
            @endcan

            {{-- Pre & Post Operasi --}}
            @can('pre post')
            <li class="nav-item dropdown  {{ Request::is('pre-post/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-house-medical-circle-check"></i> <span> Pre & Post Operasi</span></a>
                @can('pre operasi')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pre-post/pre-operasi*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('operasi.pre-operasi.index')}}">Pre Operasi</a>
                    </li>
                </ul>
                @endcan
                @can('post operasi')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pre-post/post-operasi*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('operasi.post-operasi.index')}}">Post Operasi</a>
                    </li>
                </ul>
                @endcan
                @can('berkas pre post')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pre-post/berkas-prepost*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('operasi.berkas-prepost.index')}}">Berkas Pre Post</a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan

            {{-- Pra Bedah --}}
            @can('pra bedah')
            <li class="nav-item dropdown  {{ Request::is('prabedah/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bed-pulse"></i> <span>Pra Bedah</span></a>
                @can('assesmen pra bedah')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('prabedah/assesmen-prabedah*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('prabedah.assesmen-prabedah.index')}}">Assesmen Pra Bedah</a>
                    </li>
                </ul>
                @endcan
                @can('verifikasi pra bedah')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('prabedah/verifikasi-prabedah*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('prabedah.verifikasi-prabedah.index')}}">Verifikasi Pra Bedah</a>
                    </li>
                </ul>
                @endcan
                @can('berkas pra bedah')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('prabedah/berkas-prabedah*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('prabedah.berkas-prabedah.index')}}">Berkas Pra Bedah</a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan

            {{-- belum clear --}}
            {{-- @can('pasca bedah')
            <li class="nav-item dropdown  {{ Request::is('pascabedah/*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bed-pulse"></i> <span>Pasca Bedah</span></a>
            @can('perencanaan pasca bedah')
            <ul class="dropdown-menu">
                <li class="{{ Request::is('pascabedah/perencanaan-pascabedah*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pascabedah.perencanaan-pascabedah.index')}}">Perencanaan Pasca Bedah</a>
                </li>
            </ul>
            @endcan
            </li>
            @endcan --}}

            {{-- Laporan Operasi --}}
            @can('laporan operasi')
            <li class="{{ Request::is('laporan/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan.operasi.index')}}"><i class="fas fa-book-medical"></i> <span>Laporan Operasi</span></a></li>
            @endcan

            @can('pasca bedah')
            <li class="{{ Request::is('pascabedah/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pascabedah.perencanaan-pascabedah.index')}}"><i class="fas fa-book-medical"></i> <span>Pasca Bedah</span></a></li>
            @endcan

            @can('ttd tanda operasi')
            <li class="nav-item dropdown  {{ Request::is('ttd-ok/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span> Tanda Tangan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('ttd-ok/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('ttd-ok.penandaan.index')}}">Tanda Operasi</a>
                    </li>
                </ul>
            </li>
            @endcan
            @endcan

            @can('igd')
            <li class="menu-header">IGD</li>
            <li class="nav-item dropdown {{ Request::is('igd*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Layanan IGD</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('igd/triase*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('triase.index')}}">Triase</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('igd/layananIGD/assesmenPerawat*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('layanan.assesmenPerawat')}}">Asesmen Keperawatan</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="#">Asesmen Kebidanan</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="#">Catatan Keperawatan</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('igd/layananIGD/ewsDewasa*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('layanan.ewsDewasa')}}">EWS Dewasa</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('igd/layananIGD/ewsHamil*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('layanan.ewsHamil')}}">EWS Ibu Hamil</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('igd/layananIGD/ewsAnak*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('layanan.ewsAnak')}}">EWS Anak</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="#">Asasmen Neonatus</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="#">CPPT Igd</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('igd/layananIGD/SkriningTB*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('layanan.skriningIndex')}}">Skrining TB</a>
                    </li>
                </ul>

            </li>
            @endcan
            @can('rekam medis')
            <li class="menu-header">Rekam Medis</li>
            <li class="nav-item dropdown  {{ Request::is('rm/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Riwayat Rekam Medis</span></a>
                @can('rekam medis by mr')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('rm/riwayatRekamMedis/bymr/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rm.bymr')}}">Berkas RM by MR</a>
                    </li>
                </ul>
                @endcan
                @can('rekam medis harian')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('rm/riwayatRekamMedis/harian/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rm.harian')}}">Berkas RM Harian</a>
                    </li>
                </ul>
                @endcan
                @can('rekam medis igd')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('rm/riwayatRekamMedis/igd/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rm.igd')}}">Berkas RM IGD</a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan

            @can('farmasi')
            <li class="menu-header">Farmasi</li>
            <li class="{{ Request::is('farmasi/orderAlkes') ? 'active' : '' }}"><a class="nav-link" href="{{ route('orderAlkes.index') }}"><i class="fas fa-dashboard"></i> <span>Order Alat Kesehatan</span></a></li>

            <li class="nav-item dropdown  {{ Request::is('rm/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Farmasi</span></a>
                @can('farmasi rawat jalan')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('rm/riwayatRekamMedis/bymr/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rm.bymr')}}">Rawat Jalan</a>
                    </li>
                </ul>
                @endcan
                @can('farmasi rawat inap')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('rm/riwayatRekamMedis/harian/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rm.harian')}}">Rawat Inap</a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan

            @can('surat sakit')
            <li class="{{ Request::is('surat') ? 'active' : '' }}"><a class="nav-link" href="{{ route('surat.index') }}"><i class="fas fa-notes-medical"></i> <span>Surat Sakit/SKD</span></a></li>
            @endcan


            @can('claim bpjs')
            <li class="menu-header">Klaim</li>
            <li class="nav-item dropdown {{ Request::is('claim/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Berkas Klaim</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('claim/riwayatClaim/resume/rajal') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rm.resumeRajal')}}">Resume Rajal</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('claim/riwayatClaim/resume/ranap') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rm.resumeRanap')}}">Resume Ranap</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="#">SEP</a>
                    </li>
                </ul>

            </li>
            @endcan

            @can('koding')
            <li class="menu-header">Petugas Koding</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Koding</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('rm/riwayaRekamMedis/bymr/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('koding.index')}}">Diagnosa Rajal</a>
                    </li>
                </ul>

            </li>
            @endcan



            @can('vclaim')
            <li class="menu-header">vclaim bpjs</li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clinic-medical"></i> <span>SEP</span></a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="">Finger Peserta</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">Aproval Pengajuan</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">List Data Persetujuan</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">Update Tanggal Pulang</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Monitoring</span></a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="{{ route('monitoring.kunjungan')}}">Kunjungan</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="{{ route('monitoring.klaim')}}">Klaim</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">Klaim Jasa Raharja</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">Histori Peserta</a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-dashboard"></i> <span>E-Klaim</span></a></li>

            @endcan

            @can('ttd')
            <li class="menu-header">Tanda Tangan</li>
            <li class="nav-item dropdown {{ Request::is('ttd/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-signature"></i> <span>Tanda Tangan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('ttd/petugasTtd') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('list-ttd.index') }}">Petugas</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('ttd/pasienTtd/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('ttd.pasien.detail') }}">Pasien</a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('manage user')
            <li class="menu-header">Mengelola</li>
            <li class="nav-item dropdown {{ Request::is('mu**') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i><span>Kelola Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('mu/user*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('user.index') }}">Pengguna</a>
                    </li>
                    <li class="{{ Request::is('mu/roles*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('roles.index') }}">Peran</a>
                    </li>
                    <li class="{{ Request::is('mu/permission*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('permission.index') }}">Perizinan</a>
                    </li>
                    <li class="{{ Request::is('mu/role-permission*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rolepermission.index') }}">Peran Perizinan</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('mappings')
            <li class="nav-item dropdown {{ Request::is('mp*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa-solid fa-group-arrows-rotate ml-1"></i> <span>Mappings</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('mp/encounter*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('mapping.encounter.index')}}">Encounter</a>
                    </li>
                </ul>
            </li>
            @endcan

        </ul>


        <div class="hide-sidebar-mini mt-4 mb-4 p-3">

        </div>
    </aside>
</div>
