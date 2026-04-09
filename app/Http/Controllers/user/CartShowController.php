<?php

namespace App\Http\Controllers\user;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartShowController extends Controller
{
    public function index(){
        $products = Cart::products();
        $data = [
            'products' => $products,
        ];
        return view('user.cart',$data);
    }
    
}
