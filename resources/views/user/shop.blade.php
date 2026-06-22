@extends('layout.user')
@section('content')
    <section id="advertisement">
        <div class="container">
            <img src="{{ asset('assets/user/images/shop/advertisement.jpg') }}" alt="" />
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-products-->
                            @foreach ($categories as $category)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian" href="#{{ $category->id }}">
                                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                {{ $category->name }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{{ $category->id }}" class="panel-collapse collapse @if ($category->subCategories->contains('id', $selectedSubcategory)) in @endif">
                                        <div class="panel-body">
                                            <ul>
                                                @foreach ($category->subCategories as $subcategory)
                                                    <li><a class="js-shop-filter @if ($selectedSubcategory == $subcategory->id) active @endif" href="{{ route('shop.index', ['subcategory' => $subcategory->id]) }}">{{ $subcategory->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </div><!--/category-products-->



                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            @php
                                $priceMin = (int) request('min_price', 0);
                                $priceMax = (int) request('max_price', $maxProductPrice);
                            @endphp
                            <form class="well" id="shop-filter-form" action="{{ route('shop.index') }}" method="GET">
                                <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search">
                                <div class="text-center" style="margin-top: 15px;">
                                    <input type="text" class="span2" value=""
                                        data-slider-min="0"
                                        data-slider-max="{{ $maxProductPrice }}"
                                        data-slider-step="5"
                                        data-slider-value="[{{ $priceMin }},{{ $priceMax }}]"
                                        id="sl2">
                                    <br>
                                    <b class="pull-left">$ <span id="price_min_label">{{ $priceMin }}</span></b>
                                    <b class="pull-right">$ <span id="price_max_label">{{ $priceMax }}</span></b>
                                </div>
                                <input type="hidden" name="min_price" id="min_price" value="{{ $priceMin }}">
                                <input type="hidden" name="max_price" id="max_price" value="{{ $priceMax }}">
                                <select name="sort" class="form-control" style="margin-top: 10px;">
                                    <option value="">Newest</option>
                                    <option value="price_low" @selected(request('sort') == 'price_low')>Price low to high</option>
                                    <option value="price_high" @selected(request('sort') == 'price_high')>Price high to low</option>
                                    <option value="name" @selected(request('sort') == 'name')>Name</option>
                                </select>
                                <button class="btn btn-default btn-block" type="submit" style="margin-top: 10px;">Apply</button>
                            </form>
                        </div><!--/price-range-->

                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{ asset('assets/user/images/home/shipping.jpg') }}" alt="" />
                        </div><!--/shipping-->

                    </div>
                </div>
                {{-- featuer items --}}
                <div class="col-sm-9 padding-right">
                    <div id="shop-products">
                        @include('user.partials.product-grid')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(function() {
            function syncPriceRange(value) {
                if (!$.isArray(value)) {
                    value = String(value).split(',').map(function(item) {
                        return parseInt(item, 10);
                    });
                }

                $('#min_price').val(value[0]);
                $('#max_price').val(value[1]);
                $('#price_min_label').text(value[0]);
                $('#price_max_label').text(value[1]);
            }

            $('#sl2').on('slide slideStop', function(event) {
                syncPriceRange(event.value);
            });

            function loadShop(url, pushState) {
                $('#shop-products').css('opacity', '0.45');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#shop-products').html(response.html).css('opacity', '1');

                        if (pushState) {
                            window.history.pushState({}, '', url);
                        }
                    },
                    error: function() {
                        $('#shop-products').css('opacity', '1');
                        Swal.fire({
                            title: 'Filter failed',
                            text: 'Please try again.',
                            icon: 'warning'
                        });
                    }
                });
            }

            $('#shop-filter-form').on('submit', function(e) {
                e.preventDefault();
                var query = $(this).serialize();
                loadShop($(this).attr('action') + '?' + query, true);
            });

            $('#header-search-form').on('submit', function(e) {
                e.preventDefault();
                $('#shop-filter-form input[name="search"]').val($(this).find('input[name="search"]').val());
                $('#shop-filter-form').trigger('submit');
            });

            $(document).on('click', '.js-shop-filter, .ajax-pagination a', function(e) {
                e.preventDefault();
                loadShop($(this).attr('href'), true);
            });

            window.onpopstate = function() {
                loadShop(window.location.href, false);
            };
        });
    </script>
@endsection
