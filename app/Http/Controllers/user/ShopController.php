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
        $query = Product::query()
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
            });

        match ($request->query('sort')) {
            'price_low' => $query->orderBy('price'),
            'price_high' => $query->orderByDesc('price'),
            'name' => $query->orderBy('name'),
            default => $query->latest(),
        };

        $products = $query->paginate(9)->withQueryString();

        $data = [
            'products' => $products,
            'categories' => Category::with('subCategories')->get(),
            'selectedSubcategory' => $selectedSubcategory,
            'maxProductPrice' => Product::max('price') ?: 1000,
        ];

        if ($request->ajax()) {
            return response()->json([
                'html' => view('user.partials.product-grid', $data)->render(),
            ]);
        }

        return view('user.shop', $data);
    }
}
