<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Team';
        $data['teams'] = Team::withTrashed()->paginate(5);
        return view('back.team.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Team';
        return view('back.team.create',$data);
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
            'name'=>'required',
            'designation'=>'required',
            'image'=>'required|image'
        ]);
        $data = $request->except('_token');

        $slug = Str::slug($request->name, '-').'-'.rand(000,999);
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $slug.rand(000,999).$file->getClientOriginalName();
            $file->move('uploads/team/',$file_name);
            $data['image'] = 'uploads/team/' . $file_name;
        }


        Team::create($data);
        session()->flash('message', 'Team member added successfully');
        return redirect()->route('team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $data['title'] = 'Team';
        $data['team'] = $team;
        return view('back.team.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name'=>'required',
            'designation'=>'required',
            'image'=>'image'
        ]);
        $data = $request->except('_token');

        $slug = Str::slug($request->name, '-').'-'.rand(000,999);
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $slug.rand(000,999).$file->getClientOriginalName();
            $file->move('uploads/team/',$file_name);
            unlink($team->image);
            $data['image'] = 'uploads/team/' . $file_name;
        }

        $team->update($data);
        session()->flash('message', 'Team member updated successfully');
        return redirect()->route('team.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        session()->flash('message','Team member deleted successfully');
        return redirect()->route('team.index');
    }


    public function restore($id)
    {
        $team = Team::onlyTrashed()->findOrFail($id);
        $team->restore();
        session()->flash('message','Team Member Restored Successfully');
        return redirect()->route('team.index');
    }

    public function delete($id)
    {
        $team = Team::onlyTrashed()->findOrFail($id);
        unlink($team->image);
        $team->forceDelete();
        session()->flash('message','Team Member Removed Permanently');
        return redirect()->route('team.index');
    }
}
