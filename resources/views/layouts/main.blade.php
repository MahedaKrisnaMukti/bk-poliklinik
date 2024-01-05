<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}" />
    <link rel="shortcut icon" href="/assets/images-custom/logo.png">

    @include('partials.head')

    @yield('custom_head')
</head>

@yield('custom_css')

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu"
    data-color="bg-gradient-x-purple-blue" data-col="2-columns">

    @include('partials.navbar')

    @include('partials.sidebar')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-lg-12 col-md-12">
                        @include('partials.alert')

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    @include('partials.js')

    @include('partials.custom-js')

    @yield('custom_js')
</body>

</html>
