<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MetersModel;
use App\Models\BatteryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Alert;

class MetersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meters = MetersModel::join('battery','meters.id_battery','battery.id_battery')
                ->join('users','battery.id_users','users.id')->select('meters.*','battery.id_battery','users.name')->latest()->paginate(5);        
        return view('admin.meters.meters_view',compact('meters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get(); 
        $battery = BatteryModel::join('users','battery.id_users','users.id')->get(); 
        return view('admin.meters.create_view_meters',compact('users','battery'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([                        
            'id_battery' => ['required', 'string','min:1'],
            'nm_meters' => ['required', 'string', 'max:255',],
            'm_volt' => ['required','integer','min:1'],
            'm_ampere' => ['required','integer','min:1'],            
        ]);

        $sum_watt = $request->m_volt * $request->m_ampere;

        //create post
        MetersModel::create([                        
            'id_battery'     => $request->id_battery,
            'nm_meters'   => $request->nm_meters,
            'm_volt'   => $request->m_volt,            
            'm_ampere'   => $request->m_ampere,            
            'm_watt'   => $sum_watt,            
        ]);

        //redirect to index
        Alert::success('Success!', 'Meters Created Successfully');
        return redirect()->route('meters.index');
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
        $battery = BatteryModel::get();
        $get_meters = MetersModel::where('id_meters',$id)->first();
        return view('admin.meters.update_view_meters',compact('battery','get_meters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([                        
            'id_battery' => ['required', 'string','min:1'],
            'nm_meters' => ['required', 'string', 'max:255',],
            'm_volt' => ['required','integer','min:1'],
            'm_ampere' => ['required','integer','min:1'],            
        ]);

        $sum_watt = $request->m_volt * $request->m_ampere;

        $get_meters = MetersModel::where('id_meters',$id)->first();

        //Update        
        $get_meters->where('id_meters',$id)->update([   
            'id_battery'     => $request->id_battery,
            'nm_meters'   => $request->nm_meters,
            'm_volt'   => $request->m_volt,            
            'm_ampere'   => $request->m_ampere,            
            'm_watt'   => $sum_watt, 
        ]);

        //redirect to index
        Alert::success('Success!', 'Meters Update Successfully');
        return redirect()->route('meters.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $get_meters = MetersModel::where('id_meters',$id)->first();
        $get_meters->where('id_meters',$id)->delete();

        Alert::success('Success!', 'Meters Delete Successfully');
        return redirect()->route('meters.index');
    }
}
