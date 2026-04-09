<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function index($id){
        $product = Product::with('images')->find($id);
        if (!$product) {
            return redirect()->route('home')->with('error', 'Product not found');
        }
        $categories =Category::with('subCategories')->get();
        $related = Product::where('subcategory_id', $product->subcategory_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(6)
            ->get();
        $data = [
            'product' => $product,
            'categories' => $categories,
            'related'=>$related,


        ];
        return view('user.productdetails', $data);
    }
}
