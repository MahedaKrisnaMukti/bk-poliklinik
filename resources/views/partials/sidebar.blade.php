<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true"
    data-img="/assets-chameleon/app-assets/images/backgrounds/02.jpg">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="/">
                    <img class="brand-logo" alt="" src="/assets/images-custom/logo.png" />

                    <h3 class="brand-text">
                        BK Poliklinik
                    </h3>
                </a>
            </li>

            <li class="nav-item d-md-none">
                <a class="nav-link close-navbar">
                    <i class="ft-x"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="navigation-background"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->is('menu-utama*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="/menu-utama">
                    <i class="ft-home"></i>

                    <span class="menu-title text-truncate">
                        Menu Utama
                    </span>
                </a>
            </li>

            {{-- * Menu Admin --}}
            @if (auth()->user()->role == 'Admin')
                <li class="nav-item {{ request()->is('admin/dokter*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/admin/dokter">
                        <i class="ft-list"></i>

                        <span class="menu-title text-truncate">
                            Dokter
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/pasien*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/admin/pasien">
                        <i class="ft-list"></i>

                        <span class="menu-title text-truncate">
                            Pasien
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/poli*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/admin/poli">
                        <i class="ft-list"></i>

                        <span class="menu-title text-truncate">
                            Poli
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/obat*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/admin/obat">
                        <i class="ft-list"></i>

                        <span class="menu-title text-truncate">
                            Obat
                        </span>
                    </a>
                </li>
            @endif

            {{-- * Menu Pasien --}}
            @if (auth()->user()->role == 'Pasien')
                <li class="nav-item {{ request()->is('pasien/mendaftar-poli*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/pasien/mendaftar-poli">
                        <i class="ft-list"></i>

                        <span class="menu-title text-truncate">
                            Mendaftar Poli
                        </span>
                    </a>
                </li>
            @endif

            {{-- * Dokter --}}
            @if (auth()->user()->role == 'Dokter')
                <li class="nav-item {{ request()->is('dokter/jadwal-periksa*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/dokter/jadwal-periksa">
                        <i class="ft-calendar"></i>

                        <span class="menu-title text-truncate">
                            Jadwal Periksa
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dokter/daftar-pasien*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/dokter/daftar-pasien">
                        <i class="ft-users"></i>

                        <span class="menu-title text-truncate">
                            Daftar Pasien
                        </span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dokter/riwayat-pasien*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/dokter/riwayat-pasien">
                        <i class="ft-user-check"></i>

                        <span class="menu-title text-truncate">
                            Riwayat Pasien
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
