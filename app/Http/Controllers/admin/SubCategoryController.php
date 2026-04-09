<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $subcategories = SubCategory::all();
         $data = [
            'title' => 'Create Subcategory',
            'heading' => 'Create Subcategory',
            'active' => 'subcategory',
            'subcategories' => $subcategories,
        ];

        return view('admin.subcategory.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     $categories = Category::all();
         $data = [
            'title' => 'Create Subcategory',
            'heading' => 'Create Subcategory',
            'active' => 'subcategory',
            'categories' => $categories,
        ];

        return  view('admin.subcategory.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SubCategory::create([
            'name'=> $request->name,
            'category_id' => $request->category_id,
        ]);
        return redirect('admin/subcategory/index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $subcategory = SubCategory::find($id);

         $categories = Category::all();
          $data = [
            'heading' => ' Edit SubCategoray ',
            'title' => ' Edit SubCategory ',
            'active' => 'subcategory',
          'subcategory' => $subcategory,
          'categories'=> $categories
        ];

        return view('admin.subcategory.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $subcategory = SubCategory::find($request->id);
        $subcategory->update([
            'name' => $request->name,
        ]);
        return redirect()->route('subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $subcategories= SubCategory::find($id);
    $subcategories->delete();
    return redirect()->back();
    }
}
