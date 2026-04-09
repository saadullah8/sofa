<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $products=Product::latest()->take(6)->get();
        $data=[
'products'=>$products,
'categories'=>Category::all(),
        ];
        return view('user.home',$data);
    }
}
