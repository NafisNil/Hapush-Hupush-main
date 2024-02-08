<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Requests\TermRequest;
class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $term = Term::orderBy('id', 'desc')->first();
        $termCount = Term::count();
         return view('admin.term.index',['term'=>$term,'termCount'=> $termCount,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.term.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TermRequest $request)
    {
        //
        $term = Term::create($request->all());
        return redirect()->route('term.index')->with('success','Data inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Term $term)
    {
        //
        return view('admin.term.edit',[
            'edit' => $term
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TermRequest $request, Term $term)
    {
        //
        $term->update($request->all());
        return redirect()->route('term.index')->with('success','Data inserted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Term $term)
    {
        //
        $term->delete();
        return redirect()->route('term.index')->with('status','Data deleted successfully!');
    }
}
