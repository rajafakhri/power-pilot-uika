<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BatteryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Alert;

class BatteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $battery = BatteryModel::latest()->paginate(5);        
        return view('admin.battery.battery_view',compact('battery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        return view('admin.battery.create_view_battery',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([            
            'id_users' => ['required', 'integer'],
            'nm_battery' => ['required', 'string', 'max:255',],
            'capacity' => ['required','integer'],
        ]);

        $count_batt = DB::table('battery')->where('id_users',$request->id_users,)->count();
        if($count_batt < 3){
            //create post
            BatteryModel::create([
                'id_users'     => $request->id_users,
                'nm_battery'   => $request->nm_battery,
                'capacity'   => $request->capacity,
                'residu_val'   => $request->capacity,
            ]);
            //redirect to index
            Alert::success('Success!', 'Battery Created Successfully');
            return redirect()->route('battery.index');
        }else{
            //redirect to index
            Alert::error('Error!', 'Battery is More Than 3');
            return redirect()->route('battery.index');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get post by ID
        $users = User::get();
        $get_battery = BatteryModel::where('id_battery',$id)->first();
        return view('admin.battery.update_view_battery',compact('get_battery','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([                        
            'id_users' => ['required', 'integer'],
            'nm_battery' => ['required', 'string', 'max:255',],
            'capacity' => ['required','integer'],
        ]);        

        $get_battery = BatteryModel::where('id_battery',$id)->first();

        $check_us = BatteryModel::where('id_users',$request->id_users)->first();          
        $get_battery->where('id_battery',$id)->update([   
            'id_users'     => $request->id_users,             
            'nm_battery'   => $request->nm_battery,
            'capacity'   => $request->capacity,
            'residu_val'   => $request->capacity,
        ]);
        //redirect to index
        Alert::success('Success!', 'Battery Updated Successfully');
        return redirect()->route('battery.index');        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $get_battery = BatteryModel::where('id_battery',$id)->first();
        $get_battery->where('id_battery',$id)->delete();

        Alert::success('Success!', 'Battery Delete Successfully');
        return redirect()->route('battery.index');
    }
}
