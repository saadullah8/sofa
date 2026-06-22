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
                                                    <li><a class="@if ($selectedSubcategory == $subcategory->id) active @endif" href="{{ route('shop.index', ['subcategory' => $subcategory->id]) }}">{{ $subcategory->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </div><!--/category-products-->



                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <form class="well" action="{{ route('shop.index') }}" method="GET">
                                <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search">
                                <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}" placeholder="Min price" style="margin-top: 10px;">
                                <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="Max price" style="margin-top: 10px;">
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
                    <div class="text-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
