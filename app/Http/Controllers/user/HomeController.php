<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $selectedSubcategory = $request->query('subcategory');
        $products = Product::latest()
            ->when($selectedSubcategory, function ($query) use ($selectedSubcategory) {
                $query->where('subcategory_id', $selectedSubcategory);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('min_price'), function ($query) use ($request) {
                $query->where('price', '>=', (int) $request->min_price);
            })
            ->when($request->filled('max_price'), function ($query) use ($request) {
                $query->where('price', '<=', (int) $request->max_price);
            })
            ->take(6)
            ->get();

        $data = [
            'products' => $products,
            'categories' => Category::with('subCategories')->get(),
            'selectedSubcategory' => $selectedSubcategory,
            'maxProductPrice' => Product::max('price') ?: 1000,
        ];

        return view('user.home', $data);
    }
}
