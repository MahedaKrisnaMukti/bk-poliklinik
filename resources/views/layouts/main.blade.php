<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}" />
    <meta name="keywords" content="{{ $keywords }}" />
    <link rel="shortcut icon" href="/assets/images-custom/logo.png" />

    @include('partials.head')

    @yield('custom_head')
</head>

@yield('custom_css')

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    @include('partials.navbar')

    @include('partials.sidebar')

    @include('partials.alert')

    <div class="app-content content">
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <div class="row match-height">

                    @yield('content')

                </div>
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('partials.footer')

    @include('partials.js')

    @include('partials.custom-js')

    @yield('custom_js')
</body>

</html>
