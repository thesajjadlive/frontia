<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type !== 'operator'){
            $data['title'] = 'Logo And Links';
            $data['logo_links'] = Link::withTrashed()->first();

            return view('back.logo_links.index',$data);

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
            'logo'=>'image|max:10000',
            'facebook'=>'max:1000',
            'twitter'=>'max:1000',
            'instagram'=>'max:1000',
            'skype'=>'max:1000',
        ]);
        $links = $request->except('_token','logo');

        $data_logo_links=Link::withTrashed()->first();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file_name = time().'tl'.rand(0000,9999).'.'.$file->getClientoriginalExtension();
            if($data_logo_links){
                unlink($data_logo_links->logo);
            }
            $file->move('uploads/logo/',$file_name);
            $links['logo'] = 'uploads/logo/' . $file_name;
        }

        if($data_logo_links){
            Link::find($data_logo_links->id)->update($links);
            session()->flash('success','Logo & Links Updated Successfully');
        }
        else{
            Link::create($links);
            session()->flash('success','Logo & Links Inserted Successfully');
        }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        //
    }
}
