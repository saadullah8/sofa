<div class="features_items">
    <h2 class="title text-center">Features Items</h2>
    @forelse ($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
                        <h2>${{ $product->price }}</h2>
                        <p>{{ $product->name }}</p>
                        <button type="button" class="btn btn-default add-to-cart js-add-to-cart" data-product-id="{{ $product->id }}">
                            <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>${{ $product->price }}</h2>
                            <p>{{ $product->name }}</p>
                            <a href="{{ route('productdetails', $product->id) }}" class="btn btn-default add-to-cart">
                                <i class="fa fa-eye"></i>View details
                            </a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="{{ route('productdetails', $product->id) }}"><i class="fa fa-plus-square"></i>Details</a></li>
                        <li><a href="#" class="js-add-to-cart" data-product-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i>Add</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @empty
        <div class="col-sm-12">
            <p class="text-center">No products found.</p>
        </div>
    @endforelse
</div>
<div class="text-center ajax-pagination">
    {{ $products->links() }}
</div>
