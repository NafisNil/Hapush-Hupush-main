<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contact = Contact::orderBy('id', 'desc')->first();
        $contactCount = Contact::count();
         return view('admin.contact.index',['contact'=>$contact,'contactCount'=> $contactCount,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        //
        $contact = Contact::create($request->all());
        return redirect()->route('contact.index')->with('success','Data inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
        return view('admin.contact.edit',[
            'edit' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        //
        $contact->update($request->all());
        return redirect()->route('contact.index')->with('success','Data inserted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
        $contact->delete();
        return redirect()->route('contact.index')->with('status','Data deleted successfully!');
    }
}
