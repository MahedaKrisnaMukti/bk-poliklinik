<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}" />
    <link rel="shortcut icon" href="/assets/images-custom/logo.png">

    <link rel="stylesheet" href="/assets/vendor/css/pages/page-auth.css" />

    @include('partials.head')

    @yield('custom_head')
</head>

@yield('custom_css')

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                @include('partials.alert')

                <div class="card">
                    <div class="card-body">
                        <img class="logo d-flex" src="/assets/images-custom/logo.png" style="margin: auto">

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.js')

    @include('partials.custom-js')

    @yield('custom_js')
</body>

</html>
