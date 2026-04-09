<?php

namespace App\Http\Controllers\admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Stuff;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Productimages;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $products=Product::with(['category','subcategory','size','color','stuff'])->get();
    $data=[
        'heading'=>'Products',
        'title'=>'View Products',
        'active'=>'product',
        'products'=>$products,
    ];
    return view('admin.product.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories=Category::all();
        $sizes=Size::all();
        $colors=Color::all();
        $stuffs=Stuff::all();
        $data=[
        'heading'=>'Products',
        'title'=>'View Products',
        'active'=>'product',
        'categories'=>$categories,
        'sizes'=>$sizes,
        'colors'=>$colors,
        'stuffs'=>$stuffs,
    ];
    return view('admin.product.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $path = ImageHelper::saveImage($request->image, 'Image');
        $product=Product::create([
            'category_id' =>$request->category_id,
            'subcategory_id' =>$request->subcategory_id,
            'size_id'=>$request->size_id,
            'color_id'=>$request->color_id,
            'stuff_id'=>$request->stuff_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $path,
            'stock' =>$request->stock,
            'description' => $request->description,
        ]);
         if($request->images){
            foreach($request->images as $image){
                $path = ImageHelper::saveImage($image, 'Image');
                Productimages::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }
        // dd($request->image);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    $product=Product::find ($id);
    $data=[
        'heading'=>'Product',
        'title'=>' Product Details',
        'active'=>'product',
        'product'=>$product,
    ];
    return view('admin.product.detail',$data);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
     $product = Product::find($id);
           $categories = Category::all();
        $subcategories = SubCategory::where('category_id',$product->category_id)->get();
        $sizes = Size::all();
        $colors=Color::all();
        $stuffs=Stuff::all();
              $data =[
            'heading' => ' Edit Products',
            'title' => 'Edit Produts',
            'active' => 'product',
            'product' => $product,
             'categories'=>$categories,
            'subcategories'=>$subcategories,
            'sizes'=>$sizes,
             'colors'=>$colors,
        'stuffs'=>$stuffs,
           
        ];

    return view('admin.product.edit',   $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         $product = Product::find($request->id);
        $data = $request->all();
        if($request->image){
            $path = ImageHelper::saveImage($request->image, 'Image');
            $data['image'] = $path;
            $product->update($data);

        }else{
                $data['image'] = $product->image;
                $product->update($data);
        }
    return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     $product = Product::find($id);
        $product->delete();
        return redirect()->back();
    }
    public function deleteimage($id){
$image=Productimages::find($id);
$image->delete();
return redirect()->back();
    }
}
