<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sofa Shop ecommerce store">
    <title>{{ $title ?? 'Sofa Shop' }}</title>

    <link href="{{ asset('assets/user/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user/css/responsive.css') }}" rel="stylesheet">

    <style>
        .cart-count {
            background: #fe980f;
            border-radius: 10px;
            color: #fff;
            display: inline-block;
            font-size: 11px;
            line-height: 16px;
            margin-left: 4px;
            min-width: 18px;
            text-align: center;
        }

        .search_box input {
            width: 100%;
        }

        .footer-bottom p {
            margin-bottom: 0;
        }
    </style>

    @yield('style')
</head>

<body>
    <header id="header">
        <div class="header_top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="{{ route('contact') }}"><i class="fa fa-phone"></i> +92 300 0000000</a></li>
                                <li><a href="{{ route('contact') }}"><i class="fa fa-envelope"></i> support@sofashop.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/user/images/home/logo.png') }}" alt="Sofa Shop">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                @auth
                                    <li><a href="#"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a></li>
                                @else
                                    <li><a href="{{ route('login') }}"><i class="fa fa-user"></i> Account</a></li>
                                @endauth
                                <li><a href="{{ route('user.cart') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li>
                                    <a href="{{ route('user.cart') }}">
                                        <i class="fa fa-shopping-cart"></i> Cart
                                        <span id="cart_qty" class="cart-count">{{ App\Helpers\Cart::qty() }}</span>
                                    </a>
                                </li>
                                @auth
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('frontend-logout-form').submit();">
                                            <i class="fa fa-lock"></i> Logout
                                        </a>
                                    </li>
                                @else
                                    <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Login</a></li>
                                @endauth
                            </ul>
                            <form id="frontend-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                                <li><a href="{{ route('shop.index') }}" class="{{ request()->routeIs('shop.index') ? 'active' : '' }}">Shop</a></li>
                                <li><a href="{{ route('user.cart') }}" class="{{ request()->routeIs('user.cart') ? 'active' : '' }}">Cart</a></li>
                                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <form class="search_box pull-right" id="header-search-form" action="{{ route('shop.index') }}" method="GET">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <footer id="footer">
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="companyinfo">
                            <h2><span>Sofa</span> Shop</h2>
                            <p>Comfortable sofas, chairs, and seating essentials with secure online checkout.</p>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{ route('contact') }}">Online Help</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                <li><a href="{{ route('user.cart') }}">Checkout</a></li>
                                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quick Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('shop.index') }}">Products</a></li>
                                <li><a href="{{ route('user.cart') }}">Cart</a></li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Newsletter</h2>
                            <form action="{{ route('shop.index') }}" method="GET" class="searchform">
                                <input type="email" placeholder="Your email address">
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get updates about new arrivals and offers.</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © {{ date('Y') }} Sofa Shop. All rights reserved.</p>
                    <p class="pull-right">Secure shopping powered by Stripe</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/user/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/price-range.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('assets/user/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.js-add-to-cart', function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            var qty = $(this).data('qty') || 1;

            $.ajax({
                url: "{{ url('cart/add') }}/" + productId + "/" + qty,
                type: "GET",
                success: function(response) {
                    $('#cart_qty').html(response.qty);
                    Swal.fire({
                        title: "Product added",
                        icon: "success",
                        timer: 1200,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: "Unable to add",
                        text: xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Please try again.",
                        icon: "warning"
                    });
                }
            });
        });
    </script>
    @yield('script')
</body>

</html>
