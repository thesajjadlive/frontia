<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Http\Request;

use App\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        if (Auth::user()->type !== 'operator'){
            $data['title'] = 'Contacts';
            $data['contacts'] = Contact::withTrashed()->first();

            return view('back.contact.index',$data);

        }
        else{
            session()->flash('error','Unauthorized Request');
            return redirect()->back();
        }
    }

    //insert contact info
    public function store(Request $request)
    {

        $request->validate([
            'phone'=>'required|numeric|min:11',
            'email'=>'required|email',
            'address'=>'required',
            'map'=>'required',
        ]);
        $contacts = $request->except('_token');

        $table_data=Contact::withTrashed()->first();

        if($table_data){
            Contact::find($table_data->id)->update($contacts);
            session()->flash('success','Contact Updated Successfully');
        }
        else{
            Contact::create($contacts);
            session()->flash('success','Contact Inserted Successfully');
        }


        return redirect()->back();
    }


}
