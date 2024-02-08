<?php

namespace App\Http\Controllers;

use App\Models\Running;
use Illuminate\Http\Request;
use App\Http\Requests\RunningRequest;
use Image;
class RunningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $running = Running::orderBy('id', 'desc')->get();
        return view('admin.running.index',['running'=>$running]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.running.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RunningRequest $request)
    {
        //
        $running = Running::create($request->all());
        if ($request->hasFile('logo')) {
            $this->_uploadImage($request, $running);
        }
        return redirect()->route('running.index')->with('success','Data inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Running $running)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Running $running)
    {
        //
        return view('admin.running.edit',[
            'edit' => $running
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RunningRequest $request, Running $running)
    {
        //
        $running->update($request->all());
        if ($request->hasFile('logo')) {
            @unlink('storage/'.$running->logo);
            $this->_uploadImage($request, $running);
        }
        return redirect()->route('running.index')->with('success','Data inserted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Running $running)
    {
        //
        if(!empty($running->logo));
        @unlink('storage/'.$running->logo);
        $running->delete();
        return redirect()->route('running.index')->with('status','Data deleted successfully!');
    }


    private function _uploadImage($request, $about)
    {
        # code...
        if( $request->hasFile('logo') ) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(432, 475)->save('storage/' . $filename);
            $about->logo = $filename;
            $about->save();
        }
       
    }
}
