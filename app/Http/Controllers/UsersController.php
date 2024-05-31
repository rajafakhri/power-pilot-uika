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
        $record_data = RecordElecUseModel::where('id_users',$id)
        ->join('users','record_elec_use.id_users','users.id')->select('record_elec_use.*','users.id','users.name')->latest()->paginate(5);
        return view('admin.data_users.details_electric',compact('record_data','id'));        
    }

    public function rand_watt_home($id){        
        
        $gen_1 = 1000; //Generator 1
        $gen_2 = 200; //Generator 2
        $gen_3 = 200; //Generator 3
        
        $usage = 1000;  //Pemakaian Listrik
        $sum_generator = $gen_1 + $gen_2 + $gen_3; //Hitung Listrik dari Generator
        $sum_gen_usage = $sum_generator - $usage; // Jumlah Generator - Pemakaian        

        // Jika Generator dengan Kebutuhan Listrik Lebih atau Cukup
        if($sum_gen_usage >= 0){
            //Ambil Battrai yang masih bisa menampung Listrik
            $battery_user = DB::table('battery')->where('id_users',$id)->where('residu_val','>',0)->first();
    
            if($battery_user == TRUE){
    
                $sum_elec_to_batt = $battery_user->bat_watt + $sum_gen_usage; //Sisa Listrik dalam Battery + Sisa Listrik yang diimport
    
                // Jika Jumlah Listrik Lebih Besar dari Kapasitas Tampung Battery
                if($sum_elec_to_batt > $battery_user->capacity){
                    $kelebihan_elec = $sum_elec_to_batt - $battery_user->capacity;
                    // Update Ke Listrik Penuh
                    $update_bat = DB::table('battery')->where('id_battery',$battery_user->id_battery)->update([
                        'bat_watt' => $battery_user->capacity,
                        'residu_val' => 0,
                    ]);
    
                    // Cari Battery Lain yang Dapat Menampung Listrik
                    $battery_user2 = DB::table('battery')->where('id_users',$id)->where('residu_val','>',0)->first(); 
                    if($battery_user2 == TRUE){
                        $residu_batt = $battery_user2->residu_val - $kelebihan_elec; 
                        $update_bat = DB::table('battery')->where('id_battery',$battery_user2->id_battery)->update([
                            'bat_watt' => $kelebihan_elec,
                            'residu_val' => $residu_batt,
                        ]);                    
                        RecordElecUseModel::create([
                            'id_users'     => $id,
                            'gen_1'     => $gen_1,
                            'gen_2'     => $gen_2,
                            'gen_3'     => $gen_3,
                            'elec_usage' => $usage,
                            'elec_export' => 0,
                            'elec_import' => 0,
                        ]);
    
                    }else{
                        // Jika Tidak ada Battery yang menampung Maka Export                    
                        RecordElecUseModel::create([
                            'id_users'     => $id,
                            'gen_1'     => $gen_1,
                            'gen_2'     => $gen_2,
                            'gen_3'     => $gen_3,
                            'elec_usage' => $usage,
                            'elec_export' => $kelebihan_elec,
                            'elec_import' => 0,
                        ]);
                    }
    
                }else{
                    $residu_batt = $battery_user->residu_val - $sum_gen_usage; 
                    $update_bat = DB::table('battery')->where('id_battery',$battery_user->id_battery)->update([
                        'bat_watt' => $sum_elec_to_batt,
                        'residu_val' => $residu_batt,
                    ]);
    
                    RecordElecUseModel::create([
                        'id_users'      => $id,
                        'gen_1'         => $gen_1,
                        'gen_2'         => $gen_2,
                        'gen_3'         => $gen_3,
                        'elec_usage'    => $usage,
                        'elec_export'   => 0,
                        'elec_import'   => 0,
                    ]);
                }
    
                //redirect to indexs
                Alert::success('Success!', 'User Created Successfully');
                return back();
                 
            }
    
        }else{ 
            // Ini Import
        }
    }
}
