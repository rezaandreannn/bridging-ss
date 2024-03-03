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
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown {{ $type_menu === 'master-data' ? 'active' : '' }}" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pasien') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('pasien') }}">Pasien</a>
                    </li>
                    <li class="{{ 'dokter' == request()->path() ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('dokter') }}">Dokter</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Kunjungan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pendaftaran') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('pendaftaran') }}">Pendaftaran</a>
                    </li>
                    <li class="{{ Request::is('rujukan') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('rujukan') }}">Rujukan</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>