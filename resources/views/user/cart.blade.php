@extends('layout.user')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description">Name</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr id="table-row-{{ $product->id }}">
                                <td class="cart_product">
                                    <a href=""><img src="{{ asset($product->image) }}" alt=""
                                            style="width: 60px"></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $product->name }} </a></h4>
                                </td>
                                <td class="cart_price">
                                    <p>$ <span id="product-price-{{ $product->id }}"> {{ $product->price }}</span></p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" style="cursor: pointer;"
                                            product_id="{{ $product->id }}"> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity"
                                            value="{{ $product->qty }}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down " style="cursor: pointer;"
                                            product_id={{ $product->id }}> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">$ <span
                                            id="product-subtotal-{{ $product->id }}">{{ $product->price * $product->qty }}</span>
                                    </p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" product_id={{ $product->id }}><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section id="do_action">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span> $ <span
                                        id="cart_subtotal">{{ App\Helpers\Cart::subTotal() }}</span></span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>$ <span id="cart_grandtotal">
                                        {{ App\Helpers\Cart::grandTotal() }}</span></span></li>
                        </ul>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {


            // for increase 
            $('body').on('click', '.cart_quantity_up', function(e) {
                var product_id = $(this).attr('product_id');
                var row = $(this).closest('tr');
                var old_qty = row.find('.cart_quantity_input').val();
                old_qty = parseInt(old_qty, 10);
                var new_qty = old_qty + 1;
                row.find('.cart_quantity_input').val(new_qty);
                id = '#product-price-' + product_id;
                var product_price = $(id).html();
                product_price = parseInt(product_price, 10);
                var product_subtotal = product_price * new_qty;
                $('#product-subtotal-' + product_id).html(product_subtotal);

                $.ajax({
                    url: "{{ url('cart/quantity/increase') }}/" + product_id,
                    type: 'GET',
                    success: function(response) {
                        $('#cart_grandtotal').html(response.grandtotal);
                        $('#cart_subtotal').html(response.subtotal);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // for delete ajax
            $('body').on('click', '.cart_quantity_delete', function(e) {
                e.preventDefault();
                var product_id = $(this).attr('product_id');
                $('#table-row-' + product_id).css('display', 'none');
                $.ajax({
                    url: "{{ url('cart/product/delete') }}/" + product_id,
                    type: "GET",
                    success: function(response) {
                        $('#cart_grandtotal').html(response.grandtotal);
                        $('#cart_subtotal').html(response.subtotal);
                        $('#cart_qty').html(response.cart_qty);
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            });
            // for decrease in quantity
            $('body').on('click', '.cart_quantity_down', function(e) {
                var product_id = $(this).attr('product_id');
                var row = $(this).closest('tr');

                var old_qty = row.find('.cart_quantity_input').val();
                old_qty = parseInt(old_qty, 10);

                var new_qty = old_qty - 1;

                // stop quantity going below 1
                if (new_qty < 1) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Invalid quantity',
                            text: 'You cannot reduce less than 0.'
                        });
                    } else {
                        alert('You cannot reduce less than 0.');
                    }
                    return false;
                }

                row.find('.cart_quantity_input').val(new_qty);

                id = '#product-price-' + product_id;
                var product_price = $(id).html();
                product_price = parseInt(product_price, 10);

                var product_subtotal = product_price * new_qty;
                $('#product-subtotal-' + product_id).html(product_subtotal);

                $.ajax({
                    url: "{{ url('cart/product/decrease') }}/" + product_id,
                    type: 'GET',
                    success: function(response) {
                        $('#cart_grandtotal').html(response.grandtotal);
                        $('#cart_subtotal').html(response.subtotal);
                        $('#cart_qty').html(response.cart_qty);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

        });
    </script>
@endsection
