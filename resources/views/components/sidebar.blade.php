<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SIMRS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">MR</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('dashboard-ecommerce-dashboard') }}">Ecommerce Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">RSUMM</li>
            <li class="nav-item dropdown {{ Request::is('md*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master Data</span></a>
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
            <li class="nav-item dropdown {{ Request::is('kj*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Kunjungan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('kj/pendaftaran') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pendaftaran.index') }}">Pendaftaran</a>
                    </li>
                    <li class="{{ Request::is('kj/antrean') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('antrean.index') }}">Antrean</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Encounter</span></a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="">Poliklinik</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">IGD</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">manage</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown {{ Request::is('manage*') ? 'active' : '' }}" data-toggle="dropdown"><i class="fas fa-tasks"></i><span>Manage User</span></a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a class="nav-link" href="{{ route('user.index') }}">User</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">Role</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="">Permission</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::is('mp*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa-solid fa-group-arrows-rotate ml-1"></i> <span>Mappings</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('mp/encounter*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('mapping.encounter.index')}}">Encounter</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="{{ route('documentation.index')}}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
