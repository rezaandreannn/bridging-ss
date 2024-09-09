<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SIMRS-BRIDGE</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SB</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-dashboard"></i> <span>Dashboard</span></a></li>
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
                    <li class="{{ Request::is('fisioterapi/dokter/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('list_pasiens.dokter') }}">pemeriksaan fisioterapi</a>
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
                @can('poliklinik mata refraksi optisi')
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pm/polimata/perawat*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('poliMata.refraksi') }}">Refraksi Optisi</a>
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
                    <li class="">
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
                    <li class="">
                        <a class="nav-link" href="{{ route('layanan.ewsDewasa')}}">EWS Dewasa</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="{{ route('layanan.ewsHamil')}}">EWS Ibu Hamil</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="">
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
                    <li class="">
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
                    <li class="{{ Request::is('rm/riwayaRekamMedis/bymr/*') ? 'active' : '' }}">
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
                    <li class="{{ Request::is('rm/riwayaRekamMedis/igd/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rm.igd')}}">Berkas RM IGD</a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan
            
            @can('farmasi')
            <li class="menu-header">Farmasi</li>
            <li class="{{ Request::is('farmasi/orderAlkes') ? 'active' : '' }}"><a class="nav-link" href="{{ route('orderAlkes.index') }}"><i class="fas fa-dashboard"></i> <span>Order Alat Kesehatan</span></a></li>
            @endcan


            @can('claim bpjs')
            <li class="menu-header">Klaim</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Berkas Klaim</span></a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="#">Resume Rajal</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="#">Resume Ranap</a>
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
            <li class="menu-header">Docs</li>
            <li class="nav-item dropdown  {{ Request::is('dc*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-rocket"></i><span>Terminology</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dc/docs-location') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('docs.location') }}">Location</a>
                    </li>
                    <li class="{{ Request::is('dc/docs-organization') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('docs.organization') }}">Organization</a>
                    </li>
                    <li class="{{ Request::is('dc/docs-encounter') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('docs.encounter') }}">Encounter</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">

        </div>
    </aside>
</div>