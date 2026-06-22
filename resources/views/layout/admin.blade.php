<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/select.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        body {
            background: #f4f6f8;
        }

        .navbar-brand {
            letter-spacing: 0;
        }

        .nav-left-sidebar .nav-divider {
            color: #8f98a8;
            font-size: 11px;
            letter-spacing: .04em;
            margin-top: 12px;
            text-transform: uppercase;
        }

        .admin-sidebar-link {
            align-items: center;
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .admin-sidebar-link .nav-label,
        .nav-left-sidebar .nav-link .nav-label {
            align-items: center;
            display: flex;
            gap: 10px;
        }

        .nav-left-sidebar .submenu .nav-link {
            padding-left: 48px;
        }

        .nav-left-sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .page-header {
            margin-bottom: 20px;
        }

        .breadcrumb-link {
            color: #5969ff;
        }
    </style>

    @yield('style')
</head>

<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Sofa Shop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search">
                            </div>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets/images/avatar-1.jpg') }}" alt="" class="user-avatar-md rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">{{ auth()->user()->name ?? 'Admin' }}</h5>
                                    <span class="status"></span><span class="ml-2">Online</span>
                                </div>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                    class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="{{ route('admin.dashboard') }}">Sofa Shop Admin</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">Menu</li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'Dashboard') active @endif" href="{{ route('admin.dashboard') }}">
                                    <span class="nav-label"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</span>
                                </a>
                            </li>

                            <li class="nav-divider">Sales</li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'order') active @endif" href="{{ route('order.index') }}">
                                    <span class="nav-label"><i class="fas fa-fw fa-shopping-cart"></i> Orders</span>
                                </a>
                            </li>

                            <li class="nav-divider">Catalog</li>
                            @php
                                $catalogMenus = [
                                    ['key' => 'product', 'id' => 'product', 'icon' => 'fa-box', 'label' => 'Products', 'index' => 'product.index', 'create' => 'product.create', 'createLabel' => 'Add Product'],
                                    ['key' => 'category', 'id' => 'category', 'icon' => 'fa-tags', 'label' => 'Categories', 'index' => 'category.index', 'create' => 'category.create', 'createLabel' => 'Add Category'],
                                    ['key' => 'subcategory', 'id' => 'subcategory', 'icon' => 'fa-sitemap', 'label' => 'Subcategories', 'index' => 'subcategory.index', 'create' => 'subcategory.create', 'createLabel' => 'Add Subcategory'],
                                    ['key' => 'size', 'id' => 'size', 'icon' => 'fa-ruler-combined', 'label' => 'Sizes', 'index' => 'size.index', 'create' => 'size.create', 'createLabel' => 'Add Size'],
                                    ['key' => 'color', 'id' => 'color', 'icon' => 'fa-palette', 'label' => 'Colors', 'index' => 'color.index', 'create' => 'color.create', 'createLabel' => 'Add Color'],
                                    ['key' => 'stuff', 'id' => 'stuff', 'icon' => 'fa-layer-group', 'label' => 'Stuff', 'index' => 'stuff.index', 'create' => 'stuff.create', 'createLabel' => 'Add Stuff'],
                                ];
                            @endphp
                            @foreach ($catalogMenus as $menu)
                                <li class="nav-item">
                                    <a class="nav-link admin-sidebar-link @if ($active == $menu['key']) active @endif" href="#"
                                        data-toggle="collapse" aria-expanded="{{ $active == $menu['key'] ? 'true' : 'false' }}"
                                        data-target="#submenu-{{ $menu['id'] }}" aria-controls="submenu-{{ $menu['id'] }}">
                                        <span class="nav-label"><i class="fas fa-fw {{ $menu['icon'] }}"></i> {{ $menu['label'] }}</span>
                                        <i class="fas fa-angle-down"></i>
                                    </a>
                                    <div id="submenu-{{ $menu['id'] }}" class="collapse submenu @if ($active == $menu['key']) show @endif">
                                        <ul class="nav flex-column">
                                            <li class="nav-item"><a class="nav-link" href="{{ route($menu['index']) }}">View All</a></li>
                                            <li class="nav-item"><a class="nav-link" href="{{ route($menu['create']) }}">{{ $menu['createLabel'] }}</a></li>
                                        </ul>
                                    </div>
                                </li>
                            @endforeach

                            <li class="nav-divider">Customer</li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'contact') active @endif" href="{{ route('contact.index') }}">
                                    <span class="nav-label"><i class="fas fa-fw fa-envelope"></i> Messages</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($active == 'review') active @endif" href="{{ route('review.index') }}">
                                    <span class="nav-label"><i class="fas fa-fw fa-star"></i> Reviews</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">{{ $heading ?? 'Dashboard' }}</h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{ $heading ?? 'Dashboard' }}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>

    @yield('script')
</body>

</html>
