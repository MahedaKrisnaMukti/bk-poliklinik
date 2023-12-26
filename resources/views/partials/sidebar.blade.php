<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="/">
                    <img src="/assets/images-custom/logo.png" style="max-height: 36px;">

                    <span class="ms-1 text-dark fs-3">
                        BK Poliklinik
                    </span>
                </a>
            </li>

            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>

                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
                        data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->is('menu-utama*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/menu-utama">
                    <i data-feather="home"></i>

                    <span class="menu-title text-truncate">
                        Menu Utama
                    </span>
                </a>
            </li>

            {{-- * Menu Admin --}}
            @if (auth()->user()->role == 'Admin')
                <li class="nav-item {{ request()->is('admin/dokter*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/admin/dokter">
                        <i data-feather="database"></i>

                        <span class="menu-title text-truncate">
                            Dokter
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/pasien*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/admin/pasien">
                        <i data-feather="database"></i>

                        <span class="menu-title text-truncate">
                            Pasien
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/poli*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/admin/poli">
                        <i data-feather="database"></i>

                        <span class="menu-title text-truncate">
                            Poli
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/obat*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/admin/obat">
                        <i data-feather="database"></i>

                        <span class="menu-title text-truncate">
                            Obat
                        </span>
                    </a>
                </li>
            @endif

            {{-- * Menu Pasien --}}
            @if (auth()->user()->role == 'Pasien')
                <li class="nav-item {{ request()->is('pasien/daftar-poli*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/pasien/daftar-poli">
                        <i data-feather="list"></i>

                        <span class="menu-title text-truncate">
                            Daftar Poli
                        </span>
                    </a>
                </li>
            @endif

            {{-- * Dokter --}}
            @if (auth()->user()->role == 'Dokter')
                <li class="nav-item {{ request()->is('dokter/jadwal-periksa*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/dokter/jadwal-periksa">
                        <i data-feather="calendar"></i>

                        <span class="menu-title text-truncate">
                            Jadwal Periksa
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dokter/daftar-pasien*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/dokter/daftar-pasien">
                        <i data-feather="users"></i>

                        <span class="menu-title text-truncate">
                            Daftar Pasien
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dokter/riwayat-pasien*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/dokter/riwayat-pasien">
                        <i data-feather="user-check"></i>

                        <span class="menu-title text-truncate">
                            Riwayat Pasien
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
