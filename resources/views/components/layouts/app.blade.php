<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-bs-theme="light"
      data-color-theme="Green_Theme" data-layout="horizontal">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}"/>

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/placeholder.css') }}"/>

    <title>{{ config('app.name') }} | @yield('title', $title ?? '')</title>
    @stack('css')
    @stack('styles')
    <style>
        .fl-wrapper, .fl-flasher {
            z-index: 99999 !important;
            position: fixed !important;
        }
    </style>
</head>

<body>
<!-- Preloader -->
<div class="preloader">
    <img style="width: 15%" src="{{ asset('assets/images/logos/logo.png') }}" alt="{{ config('app.name') }}"
         class="lds-ripple img-fluid"/>
</div>
<div id="main-wrapper">
    <div class="page-wrapper">
        <!--  Header Start -->
        <header class="topbar">
            @include('layouts.partials.horizontal_header')
        </header>
        <!--  Header End -->

        @include('layouts.partials.main_menu')

        <div class="body-wrapper">
            <div class="container-fluid">
                {{ $slot }}
            </div>
        </div>
        @include('layouts.partials.customizer')
    </div>

    <!--  Search Bar -->
    @include('layouts.partials.search_modal')

</div>
<div class="dark-transparent sidebartoggler"></div>
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<!-- Import Js Files -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/theme/app.init.js') }}"></script>
<script src="{{ asset('assets/js/theme/theme.js') }}"></script>
<script src="{{ asset('assets/js/theme/app.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/toastr-init.js') }}"></script>
{{-- @livewire('wire-elements-modal') --}}


{{--<script src="{{ asset('js/app.js') }}"></script>--}}
@stack('js')
@stack('scripts')
</body>

</html>
