<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        $data = [
            'heading' => 'Contact',
            'tittle' => 'Contact info',
            'active' => 'contact',
            'contacts' => $contacts
        ];
        return view('admin.contact.index', $data);
    }

    public function create()
    {
        $data = [
            'heading' => 'Contact',
            'tittle' => 'Contact info',
            'active' => 'contact',

        ];
        return view('user.contact', $data);
    }
    public function store(Request $request)
    {
        Contact::create($request->all());
        return redirect()->route('contact');
    }
    public function show($id)
    {
        $contacts = Contact::find($id);
        $data = [
            'heading' => 'Contact',
            'tittle' => 'Contact info',
            'active' => 'contact',
            'contacts' => $contacts,
        ];
        return view('admin.contact.details', $data);
    }


    public function destroy($id)
    {
        $contacts = Contact::find($id);
        $contacts->delete();
        return redirect()->back();
    }
}
