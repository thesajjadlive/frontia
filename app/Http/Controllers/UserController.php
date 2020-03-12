<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            if (Auth::user()->type !== 'operator'){
                $data['title'] = 'Admin';

                $data['users'] = User::where('type', '!=', 'user')->where('type', '!=', 'superadmin')->latest()->withTrashed()->paginate(10);

                if (Auth::user()->type == 'superadmin'){
                    $data['users'] = User::where('type', '!=', 'user')->latest()->withTrashed()->paginate(10);
                }

                return view('back.admin.index',$data);
            }
            else{
                session()->flash('error','Unauthorized Request');
                return redirect()->back();
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->type !== 'operator'){
            $data['title']= 'Admin';
            return view('back.admin.create',$data);

        }
        else{
            session()->flash('error','Unauthorized Request');
            return redirect()->back();
        }
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
            'name' => 'required',
            'type' => 'required',
            'phone' => 'required',
            'image' => 'image',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed'
        ]);

        $data = $request->except('_token', 'password');
        $data['password'] = bcrypt($request->password);
        $slug = Str::slug($request->name, '-').'-'.rand(000,999);
        $data['slug'] = $slug;
        $data['email_verified_at'] = Carbon::now();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $slug.rand(000,999).$file->getClientOriginalName();
            $file->move('uploads/admin/',$file_name);
            $data['image'] = 'uploads/admin/' . $file_name;
        }


        User::create($data);
        session()->flash('success', 'Admin created successfully');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data['title']="Profile";
        return view('back.admin.view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->type !== 'operator'){
            $data['title']="Admin";
            if ($user->type !== 'superadmin'){
                $data['admin']=$user;
                return view('back.admin.edit',$data);
            }
            if(Auth::user()->type == 'superadmin'){
                $data['admin']=$user;
                return view('back.admin.edit',$data);
            }
            else{
                session()->flash('error','Unauthorized Request');
                return redirect()->back();
            }

        }
        else{
            session()->flash('error','Unauthorized Request');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'phone' => 'required',
            'image' => 'image',
            'email' => 'required|email',
            'password' => 'confirmed'
        ]);

        $data = $request->except('_token', 'password', 'image');
        $slug = Str::slug($request->name, '-').'-'.rand(000, 999);
        $data['slug'] = $slug;

        if ($request->password)
        {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $slug.rand(000,999).$file->getClientOriginalName();
            $file->move('uploads/admin/',$file_name);
            if ($user->image != null){
                unlink($user->image);
            }
            $data['image'] = 'uploads/admin/' . $file_name;
        }


        $user->update($data);
        session()->flash('success', 'Updated successfully');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->type !== 'superadmin'){
            $user->delete();
            session()->flash('success','Admin Deleted Successfully');
        }
        else{
            session()->flash('error','Unauthorized Request');
        }
        return redirect()->route('user.index');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        session()->flash('success','Admin Restored Successfully');
        return redirect()->route('user.index');
    }

    public function delete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        if ($user->image != null){
            unlink($user->image);
        }
        $user->forceDelete();
        session()->flash('success','Admin Permanently Removed');
        return redirect()->route('user.index');
    }


    public function customer()
    {
        $data['title'] = 'Customer List';
        $data['users'] = User::where('type', 'user')->latest()->paginate(10);

        return view('back.admin.customer',$data);
    }
}
