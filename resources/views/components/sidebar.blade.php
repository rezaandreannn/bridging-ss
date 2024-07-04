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
            <li class="menu-header">RSUMM</li>
            @can('master data')
            <li class="nav-item dropdown {{ Request::is('md*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('md/patient*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('patient.index') }}">Pasien</a>
                    </li>
                    <li class="{{ Request::is('md/dokter*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dokter.index') }}">Dokter</a>
                    </li>
                    <li class="{{ Request::is('md/organization*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('organization.index') }}">Organisasi</a>
                    </li>
                    <li class="{{ Request::is('md/location*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('location.index') }}">Lokasi</a>
                    </li>
                    <li class="{{ Request::is('md/icd10*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('icd10.index') }}">ICD 10</a>
                    </li>
                    <li class="{{ Request::is('md/jenisFisio*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('jenisFisio.index') }}">Jenis Fisio</a>
                    </li>
                </ul>
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
            <li class="nav-item dropdown {{ Request::is('fisioterapi/perawat*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Fisioterapi</span></a>
                <!-- <ul class="dropdown-menu">
                    <li class="{{ Request::is('fisioterapi/asesmen_pasien') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('asesmen_pasien.index') }}">Asesmen Perawat</a>
                    </li>
                </ul> -->
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
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Berkas</span></a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="{{ route('berkas.fisio')}}">Berkas Fisio Terapi</a>
                    </li>
                </ul>
            </li>
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
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown {{ Request::is('ttd') ? 'active' : '' }}" data-toggle="dropdown"><i class="fas fa-signature"></i> <span>Tanda Tangan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('ttd/petugas') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('list-ttd.index') }}">Petugas</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="{{ route('ttd.pasien.detail') }}">Pasien</a>
                    </li>
                </ul>
            </li>

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