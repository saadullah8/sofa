<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Stuff;
use Illuminate\Http\Request;

class StuffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $stuffs=Stuff::all();
        $data=[
            'heading'=>'Stuff',
            'title'=>'View Stuff',
            'active'=>'stuff',
            'stuffs'=>$stuffs,
        ];
        return view('admin.stuff.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     $data=[
            'heading'=>'stuff',
            'title'=>'Enter stuff',
            'active'=>'stuff'
        ];
        return view('admin.stuff.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         stuff::create([
        'stuff'=>$request->stuff,]
    );
    return redirect()->route('stuff.index');
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
        $stuff=Stuff::find($id);
        $data=[
            'heading'=>'Stuff',
            'title'=>'Enter stuff',
            'active'=>'stuff',
            'stuff'=>$stuff,
        ];
return view('admin.stuff.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         $stuff=Stuff::find($request->id);
       $stuff->update([
'stuff'=>$request->stuff,

       ]);
       return redirect()->route('stuff.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     $stuff =  Stuff::find($id);
        $stuff->delete();
        return redirect()->back();
    }
}
