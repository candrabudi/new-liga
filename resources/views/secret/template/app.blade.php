@php
    use App\Models\Website;
    $setting = Website::first();
@endphp
<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ $setting ? $setting->website_favicon : '' }}" type="image/png" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}" />

    <title>@yield('title') | {{ $setting ? $setting->website_name : 'NEXUS' }}</title>
    @stack('styles')
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="{{ $setting ? $setting->website_logo : '' }}" class="logo-icon"
                        alt="{{ $setting ? $setting->website_name : '' }}">
                </div>
                <div>
                    <h4 class="logo-text">{{ $setting ? $setting->website_name : '-' }}</h4>
                </div>
                <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
                </div>
            </div>
            @include('secret.template.menu')
        </div>
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand gap-3">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>

                    <div class="position-relative search-bar d-lg-block d-none" data-bs-toggle="modal"
                        data-bs-target="#SearchModal">
                        <input class="form-control px-5" type="search" placeholder="Search">
                        <span
                            class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-5"><i
                                class='bx bx-search'></i></span>
                    </div>


                    <div class="top-menu ms-auto">

                    </div>
                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
                            <div class="user-info">
                                <p class="user-name mb-0">Pauline Seitz</p>
                                <p class="designattion mb-0">Web Designer</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-user fs-5"></i><span>Profile</span></a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <form id="logout-form" action="{{ route('secret.logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>

                            <li>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bx bx-log-out-circle"></i>
                                    <span>Logout</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->

                @yield('content')
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2023. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->

    <!-- search modal -->
    <div class="modal" id="SearchModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header gap-2">
                    <div class="position-relative popup-search w-100">
                        <input class="form-control form-control-lg ps-5 border border-3 border-primary" type="search"
                            placeholder="Search">
                        <span
                            class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-4"><i
                                class='bx bx-search'></i></span>
                    </div>
                    <button type="button" class="btn-close d-md-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="search-list">
                        <p class="mb-1">Html Templates</p>
                        <div class="list-group">
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action active align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-angular fs-4'></i>Best Html Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-vuejs fs-4'></i>Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-magento fs-4'></i>Responsive Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-shopify fs-4'></i>eCommerce Html Templates</a>
                        </div>
                        <p class="mb-1 mt-3">Web Designe Company</p>
                        <div class="list-group">
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-windows fs-4'></i>Best Html Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-dropbox fs-4'></i>Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-opera fs-4'></i>Responsive Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-wordpress fs-4'></i>eCommerce Html Templates</a>
                        </div>
                        <p class="mb-1 mt-3">Software Development</p>
                        <div class="list-group">
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-mailchimp fs-4'></i>Best Html Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-zoom fs-4'></i>Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-sass fs-4'></i>Responsive Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-vk fs-4'></i>eCommerce Html Templates</a>
                        </div>
                        <p class="mb-1 mt-3">Online Shoping Portals</p>
                        <div class="list-group">
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-slack fs-4'></i>Best Html Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-skype fs-4'></i>Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-twitter fs-4'></i>Responsive Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class='bx bxl-vimeo fs-4'></i>eCommerce Html Templates</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @stack('scripts')
</body>

<script>
    'undefined' === typeof _trfq || (window._trfq = []);
    'undefined' === typeof _trfd && (window._trfd = []), _trfd.push({
        'tccl.baseHost': 'secureserver.net'
    }, {
        'ap': 'cpsh-oh'
    }, {
        'server': 'p3plzcpnl509132'
    }, {
        'dcenter': 'p3'
    }, {
        'cp_id': '10399385'
    }, {
        'cp_cl': '8'
    }) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.
</script>
<script src='../../../../../img1.wsimg.com/signals/js/clients/scc-c2/scc-c2.min.js'></script>
<!-- Mirrored from codervent.com/rukada/demo/vertical/ltr/app-to-do.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Sep 2025 18:01:37 GMT -->

</html>
