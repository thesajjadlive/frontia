<?php

namespace App\Http\Controllers;

use App\Privacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivacyController extends Controller
{
    public function index()
    {
        if (Auth::user()->type !== 'operator'){
            $data['title'] = 'Privacy & Policy';
            $data['privacies'] = Privacy::withTrashed()->first();

            return view('back.privacy.index',$data);

        }
        else{
            session()->flash('error','Unauthorized Request');
            return redirect()->back();
        }
    }
    //insert & update
    public function store(Request $request)
    {
        $request->validate([
            'faq'=>'',
            'privacy'=>'',
            'terms'=>'',
            'cookie'=>'',
        ]);

        $privacy = $request->except('_token','files');

        $data_privacy=Privacy::withTrashed()->first();

        if($data_privacy){
            Privacy::find($data_privacy->id)->update($privacy);
            session()->flash('success','Privacy & Policy Updated Successfully');
        }
        else{
            Privacy::create($privacy);
            session()->flash('success','Privacy & Policy Inserted Successfully');
        }


        return redirect()->back();
    }
}
