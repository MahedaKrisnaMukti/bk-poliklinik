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

    <link rel="stylesheet" type="text/css" href="/assets-chameleon/app-assets/css/pages/login-register.css">

    @yield('custom_head')

</head>

@yield('custom_css')


<body class="vertical-layout vertical-menu 1-column  bg-full-screen-image blank-page blank-page" data-open="click"
    data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="1-column">
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>

            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                @include('partials.alert')

                                @yield('content')
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    @include('partials.js')

    @include('partials.custom-js')

    @yield('custom_js')

</body>

</html>
