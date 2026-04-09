<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
public function index(){
    $products=Product::latest()->get();
    $data=[
'products'=>$products,
'categories'=> Category::all()
    ];
    return view('user.shop',$data);
    
}
}
