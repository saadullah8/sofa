<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $categories = Category::all();
        $data = [
            'title' => 'Category List',
            'heading' => 'Category List',
            'active' => 'category',
            'categories' => $categories,
        ];
        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $data = [
            'heading' => 'Categoray',
            'title' => 'View category',
            'active' => 'Category',
        ];
        return view('admin.category.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          Category::create([
            'name'=>$request->name,
        ]);
        return redirect('admin/category/index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
          $data = [
            'heading' => 'Categoray Details',
            'title' => 'Category Details',
            'active' => 'category',
          'category' => $category,
        ];

        return view('admin.category.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
          $data = [
            'heading' => ' Edit Categoray ',
            'title' => ' Edit Category ',
            'active' => 'category',
          'category' => $category,
        ];

        return view('admin.category.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         $category = Category::find($request->id);
        $category->update([
            'name' => $request->name,
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $category = Category::find($id);
    $category->delete();
    return redirect()->back();
    }

    public function subcategory($id)
    {

        $category = Category::find($id);
        $subcategories = $category->subcategories;
        return response()->json([
            'subcategories' => $subcategories,
        ]);
    }
}
