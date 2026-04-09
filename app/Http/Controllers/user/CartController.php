<?php

namespace App\Http\Controllers\user;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function add($product_id, $qty)
    {

        $response =  Cart::add($product_id, $qty);
        return response()->json(
            [
                'product' => $product_id,
                'qty' => $qty,
                'products' => Cart::products(),
                'qty' => Cart::qty()
            ]
        );
    }

    public function increase($id)
    {
        Cart::increase($id);
        return response()->json([
            'subtotal' => Cart::subTotal(),
            'grandtotal' => Cart::grandTotal(),
            'cart_qty' => Cart::qty(),
        ]);
    }

    public function delete($id)
    {
        Cart::remove($id);
        return response()->json([
            'subtotal' => Cart::subTotal(),
            'grandtotal' => Cart::grandTotal(),
            'cart_qty' => Cart::qty(),
        ]);
    }
    public function decrease($id)
    {
        Cart::decrease($id);
        return response()->json([

            'subtotal' => Cart::subTotal(),
            'grandtotal' => Cart::grandTotal(),
            'cart_qty' => Cart::qty(),
        ]);
    }
}
