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
                        <a class="nav-link" href="{{ route('patient.index') }}">Patient</a>
                    </li>
                    <li class="{{ Request::is('md/dokter*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dokter.index') }}">Practitioner</a>
                    </li>
                    <li class="{{ Request::is('md/organization*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('organization.index') }}">Organization</a>
                    </li>
                    <li class="{{ Request::is('md/location*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('location.index') }}">Location</a>
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
            <li class="menu-header">Rawat Jalan</li>
            <li class="nav-item dropdown {{ Request::is('rj*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clinic-medical"></i> <span>Nurse Record</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('rj*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rj.index') }}">Patient</a>
                    </li>
                </ul>
            </li>
            @can('fisio')
            <li class="menu-header">Fisioterapi</li>
            <li class="nav-item dropdown {{ Request::is('fisioterapi*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-medical"></i> <span>Fisioterapi</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('fisioterapi*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cppt.index') }}">CPPT Fisioterapi</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('manage user')
            <li class="menu-header">manage</li>
            <li class="nav-item dropdown {{ Request::is('mu**') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i><span>Manage User</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('mu/user*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('user.index') }}">User</a>
                    </li>
                    <li class="{{ Request::is('mu/roles*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('roles.index') }}">Role</a>
                    </li>
                    <li class="{{ Request::is('mu/permission*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('permission.index') }}">Permission</a>
                    </li>
                    <li class="{{ Request::is('mu/role-permission*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('rolepermission.index') }}">Role Permission</a>
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