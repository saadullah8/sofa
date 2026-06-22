@extends('layout.user')
@section('content')
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('assets/user/images/home/girl1.jpg') }}" class="girl img-responsive"
                                        alt="" />
                                    <img src="{{ asset('assets/user/images/home/pricing.png') }}" class="pricing"
                                        alt="" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>100% Responsive Design</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('assets/user/images/home/girl2.jpg') }}" class="girl img-responsive"
                                        alt="" />
                                    <img src="{{ asset('assets/user/images/home/pricing.png') }}" class="pricing"
                                        alt="" />
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free Ecommerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('assets/user/images/home/girl3.jpg') }}"
                                        class="girl img-responsive" alt="" />
                                    <img src="{{ asset('assets/user/images/home/pricing.png') }}" class="pricing"
                                        alt="" />
                                </div>
                            </div>

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->

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
                                                    <li><a class="@if ($selectedSubcategory == $subcategory->id) active @endif" href="{{ route('home', ['subcategory' => $subcategory->id]) }}">{{ $subcategory->name }}</a></li>
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
                            <form class="well text-center" action="{{ route('home') }}" method="GET">
                                <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">
                                <input type="text" class="span2" value="" data-slider-min="0"
                                    data-slider-max="{{ $maxProductPrice }}" data-slider-step="5"
                                    data-slider-value="[{{ $priceMin }},{{ $priceMax }}]"
                                    id="sl2"><br />
                                <b class="pull-left">$ <span id="price_min_label">{{ $priceMin }}</span></b>
                                <b class="pull-right">$ <span id="price_max_label">{{ $priceMax }}</span></b>
                                <input type="hidden" name="min_price" id="min_price" value="{{ $priceMin }}">
                                <input type="hidden" name="max_price" id="max_price" value="{{ $priceMax }}">
                                <button class="btn btn-default btn-block" type="submit" style="margin-top: 25px;">Apply</button>
                            </form>
                        </div><!--/price-range-->

                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{ asset('assets/user/images/home/shipping.jpg') }}" alt="" />
                        </div><!--/shipping-->

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @forelse ($products as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset($product->image) }}" alt="" />
                                            <h2>${{ $product->price }}</h2>
                                            <p>{{ $product->name }}</p>
                                            <button type="button" class="btn btn-default add-to-cart js-add-to-cart" data-product-id="{{ $product->id }}"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>${{ $product->price }}</h2>
                                                <p>{{ $product->name }}</p>
                                                <a href="{{route('productdetails',$product->id)}}" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-eye"></i>View details</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="{{route('productdetails',$product->id)}}"><i class="fa fa-plus-square"></i>Details</a></li>
                                            <li><a href="#" class="js-add-to-cart" data-product-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i>Add</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-sm-12">
                                <p class="text-center">No products found in this subcategory.</p>
                            </div>
                        @endforelse



                    </div><!--features_items-->

                    <!--category-tab-->
                    <div class="category-tab">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                @foreach ($categories as $key => $category)
                                    <li class="@if ($key == 0) active @endif"><a
                                            href="#cat-{{ $category->id }}" data-toggle="tab">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                                {{-- <li><a href="#blazers" data-toggle="tab">Blazers</a></li>
                                <li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>
                                <li><a href="#kids" data-toggle="tab">Kids</a></li>
                                <li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li> --}}
                            </ul>
                        </div>
                        <div class="tab-content">
                            @foreach ($categories as $key => $category)
                                <div class="tab-pane fade @if ($key == 0) active in @endif" id="cat-{{ $category->id }}">
                                    @foreach ($category->product as $pro)
                                        <div class="col-sm-3">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{ asset($pro->image) }}" alt="" />
                                                        <h2>${{ $pro->price }}</h2>
                                                        <p>{{ $pro->name }}</p>
                                                        <button type="button" class="btn btn-default add-to-cart js-add-to-cart" data-product-id="{{ $pro->id }}"><i
                                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            @endforeach


                        </div>
                    </div>
                    <!--/category-tab-->

                    <!--recommended_items-->
                    <div class="recommended_items">
                        <h2 class="title text-center">Recommended Items</h2>

                        <div id="recommended-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    @foreach ($categories as $category)
                                        @foreach ($category->product as $pro)
                                            <div class="col-sm-4 item">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <img src="{{ asset($pro->image) }}" alt="" />
                                                            <h2>${{ $pro->price }}</h2>
                                                            <p>{{ $pro->name }}</p>
                                                            <a href="#" class="btn btn-default add-to-cart js-add-to-cart" data-product-id="{{ $pro->id }}">
                                                                <i class="fa fa-shopping-cart"></i> Add to cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left recommended-item-control" href="#recommended-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>


                </div>

            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>

        </div><!--/recommended_items-->

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
        });
    </script>
@endsection
