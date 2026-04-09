<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PDO;

class ReviewController extends Controller
{
    //

    public function index()
    {
        $reviews = Review::with('product')->latest()->get();

        $data = [
            'heading' => 'Review',
            'tittle' => 'Review info',
            'active' => 'Review',
            'reviews' => $reviews
        ];
        return view('admin.review.index', $data);
    }
    public function create($id){


    $product=Product::find($id);
        $data=[
            'heading' => 'Review',
            'tittle' => 'Review info',
            'active' => 'Review',
            'product'=>$product,

        ];
        return view('user.productdetails',$data);
    }
    public function show($id)
    {
        $reviews = Review::find($id);
        $data = [
            'heading' => 'Review',
            'tittle' => 'Review info',
            'active' => 'Review',
            'reviews' => $reviews,
        ];
        return view('admin.review.detail', $data);
    }
    
    public function store(Request $request){
        Review::create([
            'product_id' => $request->product_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'review'     => $request->review,
        ]);

        return Redirect()->back();
    }
    public function destroy($id){
        $reviews = Review::find($id);
        $reviews->delete();
        return redirect()->back();
    }
}
