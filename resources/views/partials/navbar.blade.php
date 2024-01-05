<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse navbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                </ul>

                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="avatar avatar-online">
                                <img src="{{ auth()->user()->image_url }}">
                            </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right">
                                <a class="dropdown-item" href="#">
                                    <span class="avatar avatar-online">
                                        <img src="{{ auth()->user()->image_url }}">

                                        <span class="user-name text-bold-700 ml-1">
                                            {{ Session::get('name') }}
                                        </span>
                                    </span>
                                </a>

                                <a href="/menu-utama/profil" class="dropdown-item">
                                    <i class="ft-user"></i>
                                    Ubah Profil
                                </a>

                                <div class="dropdown-divider"></div>

                                <form id="form_logout" method="POST" action="/logout">
                                    @csrf

                                    <a href="javascript:void(0)" class="dropdown-item"
                                        onclick="document.getElementById('form_logout').submit()">
                                        <i class="me-50" data-feather="power"></i>
                                        Logout
                                    </a>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
