<?php

namespace App\Http\Controllers;

use App\Category;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Service';
        $data['services'] = Service::withTrashed()->paginate(10);
        return view('back.service.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Service';
        $data['categories'] = Category::get();
        return view('back.service.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'category_id'=>'required',
            'type'=>'required',
            'details'=>'required',
            'image'=>'required|image',
        ]);
        $data = $request->except('_token');

        $slug = Str::slug($request->title, '-').'-'.rand(000,999);
        $data['slug'] = $slug;


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $slug.rand(0000,9999).$file->getClientOriginalName();
            $file->move('uploads/service/',$file_name);
            $data['image'] = 'uploads/service/' . $file_name;
        }

        Service::create($data);
        session()->flash('success','Service Created Successfully');
        return redirect()->route('service.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $data['title'] = 'Service Details';
        $data['service'] = $service;
        return view('back.service.view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $data['title'] = 'Service';
        $data['categories'] = Category::get();
        $data['service'] = $service;
        return view('back.service.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title'=>'required',
            'category_id'=>'required',
            'type'=>'required',
            'details'=>'required',
            'image'=>'image',
        ]);
        $data = $request->except('_token');

        $slug = Str::slug($request->title, '-').'-'.rand(000,999);
        $data['slug'] = $slug;


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $slug.rand(0000,9999).$file->getClientOriginalName();
            $file->move('uploads/service/',$file_name);
            unlink($service->image);
            $data['image'] = 'uploads/service/' . $file_name;
        }

        $service->update($data);
        session()->flash('success','Service Updated Successfully');
        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        session()->flash('success','Service Deleted Successfully');
        return redirect()->route('service.index');
    }

    public function restore($id)
    {
        $service = Service::onlyTrashed()->findOrFail($id);
        $service->restore();
        session()->flash('success','Service Restored Successfully');
        return redirect()->route('service.index');
    }

    public function delete($id)
    {
        $service = Service::onlyTrashed()->findOrFail($id);
        unlink($service->image);
        $service->forceDelete();
        session()->flash('success','Service Permanently Removed');
        return redirect()->route('service.index');
    }
}
