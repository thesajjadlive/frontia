<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type !== 'operator'){
            $data['title'] = 'About';
            $data['abouts'] = About::withTrashed()->first();

            return view('back.about.index',$data);

        }
        else{
            session()->flash('error','Unauthorized Request');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'about'=>'required',
            'quote'=>'required',
            'image'=>'image|max:2000',
            'video'=>'required',
            'project'=>'required|numeric',
            'customer'=>'required|numeric',
            'review'=>'required|numeric',
            'follower'=>'required|numeric',
        ]);
        $about = $request->except('_token','image');

        $table_data=About::withTrashed()->first();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time().'fl'.rand(000,999).'.'.$file->getClientoriginalExtension();
            if($table_data){
                unlink($table_data->image);
            }
            $file->move('uploads/about/',$file_name);
            $about['image'] = 'uploads/about/' . $file_name;
        }

        if($table_data){
            About::find($table_data->id)->update($about);
            session()->flash('success','About Updated Successfully');
        }
        else{
            About::create($about);
            session()->flash('success','About Inserted Successfully');
        }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
