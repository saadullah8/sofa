<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request){
        $selectedSubcategory = $request->query('subcategory');
        $products = Product::latest()
            ->when($selectedSubcategory, function ($query) use ($selectedSubcategory) {
                $query->where('subcategory_id', $selectedSubcategory);
            })
            ->get();

        $data = [
            'products' => $products,
            'categories' => Category::with('subCategories')->get(),
            'selectedSubcategory' => $selectedSubcategory,
        ];

        return view('user.shop', $data);
    }
}
