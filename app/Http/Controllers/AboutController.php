<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Requests\AboutRequest;
class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $about = About::orderBy('id', 'desc')->first();
        $aboutCount = About::count();
         return view('admin.about.index',['about'=>$about,'aboutCount'=> $aboutCount,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {
        //
        $about = About::create($request->all());
      
        return redirect()->route('about.index')->with('success','Data inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        //
        return view('admin.about.edit',[
            'edit' => $about
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request, About $about)
    {
        //
        $about->update($request->all());
       
        return redirect()->route('about.index')->with('success','Data inserted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        //
        $about->delete();
        return redirect()->route('about.index')->with('status','Data deleted successfully!');
    }
}
