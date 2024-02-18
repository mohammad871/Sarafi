<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="rtl"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>
        کهاته
    </title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/logo.png') }}" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset("vendor/fonts/boxicons.css") }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset("vendor/css/core.css") }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset("vendor/css/theme-default.css") }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset("css/demo.css") }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset("vendor/libs/perfect-scrollbar/perfect-scrollbar.css") }}" />

    <link rel="stylesheet" href="{{ asset("vendor/libs/apex-charts/apex-charts.css") }}" />

    <link rel="stylesheet" href="{{ asset("css/toast.css") }}" />
    <link rel="stylesheet" href="{{ asset("css/style.css") }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/persian-datepicker/dist/kamadatepicker.min.css') }}">

    <!-- Helpers -->
    <script src="{{ asset("vendor/js/helpers.js") }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset("js/config.js") }}"></script>



    @livewireStyles

    @livewireScripts
</head>

<body >

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @if(basename(url()->current()) != "login")
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="/" class="app-brand-link">
                    <span class="app-brand-logo demo">
                      <img style="width: 38px; margin-left: 10px" src="{{ asset('img/favicon/logo.png') }}" alt="">
                    </span>
                    <span class="app-brand-text demo menu-text fw-bolder ms-2">کهاته</span>
                </a>
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="/" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">دشبورد</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('customer') ? 'active' : '' }}">
                    <a href="{{ route('customer') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Basic"> مشتریان</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('customerAccount') ? 'active' : '' }}">
                    <a href="customerAccount" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-id-card"></i>
                        <div data-i18n="Basic">صورت حساب</div>
                    </a>
                </li> 
                <li class="menu-item {{ request()->is('customerCalculation') ? 'active' : '' }}">
                    <a href="customerCalculation" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-plus"></i>
                        <div data-i18n="Basic">جمع /قرض</div>
                    </a>
                </li> 
                <li class="menu-item {{ request()->is('report') ? 'active' : '' }}">
                            <a href="/report" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-chart"></i> 
                                <div data-i18n="Basic Inputs">  بیلانس شیت</div>
                            </a>
                        </li>

                        <li class="menu-item {{ request()->is('backup') ? 'active' : '' }}">
                            <a href="/backup" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-file"></i> 
                                <div data-i18n="Input groups">بک اپ </div>
                            </a>

                        </li>
                        <li class="menu-item {{ request()->is('note') ? 'active' : '' }}">
                            <a href="/note" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-walk"></i> 
                                <div data-i18n="Input groups">یاداشت  </div>
                            </a>
                        </li>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <nav
                class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar"
            >
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                    <ul class="navbar-nav flex-row align-items-center me-auto">
                        <!-- Place this tag where you want the button to render. -->
                        <li class="nav-item lh-1 me-3">
                            <a
                                class="github-button"
                                data-icon="octicon-star"
                                data-size="large"
                                data-show-count="true"
                            >{{ ucwords(session()->get('user')->name) }}</a
                            >
                        </li>

                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar">
                                    <img src="{{ !empty(session()->get('user')->profile_photo_path) ? asset('storage/img/'.session()->get('user')->profile_photo_path) : asset("img/default.png") }}" class="w-px-40 h-px-40 rounded-circle" style="object-fit: cover; background-color: #fff; border: 1px solid var(--bs-primary)" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start">
                                <li>
                                    <a class="dropdown-item" href="/profile">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="align-middle">پروفایل من</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/logout">
                                        <i class="bx bx-power-off me-2" style="color: var(--bs-danger)"></i>
                                        <span class="align-middle">خروج</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>
            <!-- / Navbar -->
            @endif

            <!-- Content wrapper -->
            <div class="content-wrapper">
                    @yield('content')
