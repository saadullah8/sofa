<?php

namespace App\Http\Controllers\user;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($product_id, $qty)
    {
        $product = Product::findOrFail($product_id);
        $qty = max(1, (int) $qty);

        if ($qty > $product->stock) {
            return response()->json([
                'message' => 'Only ' . $product->stock . ' item(s) available in stock.',
            ], 422);
        }

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
        $product = Product::findOrFail($id);
        $currentQty = 0;

        foreach (Cart::products() as $item) {
            if ($item->id == $id) {
                $currentQty = $item->qty;
                break;
            }
        }

        if ($currentQty >= $product->stock) {
            return response()->json([
                'message' => 'No more stock available for this product.',
            ], 422);
        }

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
