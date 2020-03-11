<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Category';
        $data['categories'] = Category::withTrashed()->paginate(10);
        return view('back.category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Category';
        return view('back.category.create',$data);
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
            'name'=>'required|unique:categories',
            'icon'=>'required|image',
            'image'=>'required|image',
        ]);
        $data = $request->except('_token');

        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $file_name = $slug.rand(0000,9999).$file->getClientOriginalName();
            $file->move('uploads/category/',$file_name);
            $data['icon'] = 'uploads/category/' . $file_name;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $slug.rand(0000,9999).$file->getClientOriginalName();
            $file->move('uploads/category/',$file_name);
            $data['image'] = 'uploads/category/' . $file_name;
        }

        Category::create($data);
        session()->flash('success','Category Created Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {//dd($category);
        $data['title'] = 'Category';
        $data['category'] = $category;
        return view('back.category.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required',
            'icon'=>'required|image',
            'image'=>'required|image',
        ]);
        $data = $request->except('_token');

        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $file_name = $slug.rand(0000,9999).$file->getClientOriginalName();
            $file->move('uploads/category/',$file_name);
            unlink($category->icon);
            $data['icon'] = 'uploads/category/' . $file_name;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $slug.rand(0000,9999).$file->getClientOriginalName();
            $file->move('uploads/category/',$file_name);
            unlink($category->image);
            $data['image'] = 'uploads/category/' . $file_name;
        }


        $category->update($data);
        session()->flash('success','Category Updated Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success','Category Deleted Successfully');
        return redirect()->route('category.index');
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        session()->flash('success','Category Restored Successfully');
        return redirect()->route('category.index');
    }

    public function delete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        unlink($category->icon);
        unlink($category->image);
        $category->forceDelete();
        session()->flash('success','Category Permanently Removed');
        return redirect()->route('category.index');
    }
}
