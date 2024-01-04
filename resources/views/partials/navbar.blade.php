<nav
    class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="#">
                        <i class="ficon" data-feather="menu"></i>
                    </a>
                </li>
            </ul>
        </div>

        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">
                            {{ auth()->user()->username }}
                        </span>
                    </div>

                    <span class="avatar">
                        <img class="round" src="{{ auth()->user()->image_url }}" height="40" width="40">

                        <span class="avatar-status-online"></span>
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a href="/menu-utama/profil" class="dropdown-item">
                        <i class="me-50" data-feather="user"></i>
                        Ubah Profil
                    </a>

                    <form id="form_logout" method="POST" action="/logout">
                        @csrf

                        <a href="javascript:void(0)" class="dropdown-item"
                            onclick="document.getElementById('form_logout').submit()">
                            <i class="me-50" data-feather="power"></i>
                            Logout
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
