<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     
     
        $colors=Color::all();
        $data=[
            'heading'=>'Color',
            'title'=>'View Color',
            'active'=>'Color',
            'colors'=>$colors,
        ];
        return view('admin.color.index',$data);
    

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { $data=[
            'heading'=>'Color',
            'title'=>'Enter color',
            'active'=>'color'
        ];
        return view('admin.color.create',$data);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Color::create([
        'color'=>$request->color,]
    );
    return redirect()->route('color.index');
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
        $color=Color::find($id);
        $data=[
            'heading'=>'Color',
            'title'=>'Enter color',
            'active'=>'color',
            'color'=>$color,
        ];
return view('admin.color.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         $color=Color::find($request->id);
       $color->update([
'color'=>$request->color,

       ]);
       return redirect()->route('color.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
           $color =  Color::find($id);
        $color->delete();
        return redirect()->back();
    }
}
