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
                                    <img src="{{ asset('assets/user/images/images/home/girl3.jpg') }}"
                                        class="girl img-responsive" alt="" />
                                    <img src="{{ asset('assets/user/images/images/home/pricing.png') }}" class="pricing"
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
                                    <div id="{{ $category->id }}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                @foreach ($category->subCategories as $subcategory)
                                                    <li><a href="#">{{ $subcategory->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </div><!--/category-products-->



                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0"
                                    data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]"
                                    id="sl2"><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range-->

                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{ asset('assets/user/images/home/shipping.jpg') }}" alt="" />
                        </div><!--/shipping-->

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @foreach ($products as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset($product->image) }}" alt="" />
                                            <h2>{{ $product->price }}</h2>
                                            <p>{{ $product->name }}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>{{ $product->price }}</h2>
                                                <p>{{ $product->name }}</p>
                                                <a href="{{route('productdetails',$product->id)}}" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach



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
                            @foreach ($categories as $category)
                                <div class="tab-pane fade active in" id="cat-{{ $category->id }}">
                                    @foreach ($category->product as $pro)
                                        <div class="col-sm-3">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{ asset($pro->image) }}" alt="" />
                                                        <h2>${{ $pro->price }}</h2>
                                                        <p>{{ $pro->name }}</p>
                                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                                class="fa fa-shopping-cart"></i>Add to cart</a>
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
                                                            <a href="#" class="btn btn-default add-to-cart">
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