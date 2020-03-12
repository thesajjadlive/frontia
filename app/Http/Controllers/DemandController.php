<?php

namespace App\Http\Controllers;

use App\Demand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Responded Requests';
        $data['demands'] = Demand::with('service')->where('status','responded')->paginate(10);
        return view('back.demand.index',$data);
    }

    public function pending()
    {
        $data['title'] = 'Pending Requests';
        $data['demands'] = Demand::with('service')->where('status','pending')
            ->where('service_id','!=', null)->paginate(10);
        return view('back.demand.index',$data);
    }

    public function callback()
    {
        $data['title'] = 'Callback Requests';
        $data['demands'] = Demand::where('service_id','=', null)->paginate(10);
        return view('back.demand.index',$data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = 'Request Details';
        $data['demand'] = Demand::findOrFail($id);
        return view('back.demand.view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function edit(Demand $demand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demand $demand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demand $demand)
    {
        //
    }

    public function change_status($demand_id,$status)
    {
        if($status == 'responded' || $status == 'pending')
        {
                Demand::findOrFail($demand_id)->update(['status'=>$status]);
                session()->flash('success','Property status changed successfully');

        }
        return redirect()->back();
    }
}
