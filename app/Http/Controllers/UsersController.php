<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MetersModel;
use App\Models\BatteryModel;
use App\Models\RecordElecUseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(5);        
        return view('admin.data_users.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data_users.create_view_us');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([            
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required','string','min:8'],
            'level'   => ['required','min:1','max:3'],
        ]);        

        //create post
        User::create([            
            'name'     => $request->name,
            'email'   => $request->email,
            'password'   => Hash::make($request->password),
            'level'   => $request->level
        ]);

        //redirect to index
        Alert::success('Success!', 'User Created Successfully');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get post by ID
        $get_user = User::findOrFail($id);
        return view('admin.data_users.update_view_us',compact('get_user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([            
            'name' => ['required', 'string', 'max:255'],            
            'level'   => ['required','min:1','max:3'],
        ]);   

        //get post by ID
        $users = User::findOrFail($id);
        $f_users = DB::table('users')->where('id',$id)->first();        

        if($f_users->email == $request->email){

            if ($request->filled('password')){
                $request->validate([
                    'password' => ['required','string','min:8'],                
                ]);
                
                $users->update([
                    'name'     => $request->name,                    
                    'password'   => Hash::make($request->password),
                    'level'   => $request->level
                ]);
            }else{                
                $users->update([
                    'name'     => $request->name,                                        
                    'level'   => $request->level
                ]);
            }
        }else{
            $request->validate([                            
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],                
            ]);  
            
            if ($request->filled('password')){
                $request->validate([
                    'password' => ['required','string','min:8'],                
                ]);
                
                $users->update([
                    'name'     => $request->name,
                    'email'   => $request->email,
                    'password'   => Hash::make($request->password),
                    'level'   => $request->level
                ]);
            }else{                
                $users->update([
                    'name'     => $request->name,
                    'email'   => $request->email,                    
                    'level'   => $request->level
                ]);
            }
        }

        Alert::success('Success!', 'User Update Successfully');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get post by ID
        $users = User::findOrFail($id);
        $users->delete();

        Alert::success('Success!', 'User Delete Successfully');
        return redirect()->route('users.index');
    }

    public function details_meters($id){
        $record_data = RecordElecUseModel::where('id_users',$id)->latest()->paginate(5);  
        return view('admin.data_users.details_electric',compact('record_data','id'));        
    }

    public function rand_watt_home($id){
        
        $battery_user = BatteryModel::where('id_users',$id)->first();
        $get_watt = MetersModel::where('id_battery',$battery_user->id_battery)->sum('m_watt');

        $sum_watt_kwh = $get_watt / 1000;
    
        $watt_rand_hour = rand(0, 9999999) / 1000;
        $total_usege = $sum_watt_kwh - $watt_rand_hour;
        //create post
        RecordElecUseModel::create([
            'id_users'     => $id,
            'battery_watt'     => $sum_watt_kwh,
            'watt_hour'   => $watt_rand_hour,
            'use_kwh'   => $total_usege,            
        ]);

        //redirect to index
        Alert::success('Success!', 'User Created Successfully');
        return back();
    }
}
