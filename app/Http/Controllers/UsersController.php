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
        
        $gen_1 = 0; //Generator 1
        $gen_2 = 0; //Generator 2
        $gen_3 = 0; //Generator 3
        
        $usage = 3100;  //Pemakaian Listrik
        $sum_generator = $gen_1 + $gen_2 + $gen_3; //Hitung Listrik dari Generator
        $sum_gen_usage = $sum_generator - $usage; // Jumlah Generator - Pemakaian        

        // Jika Generator dengan Kebutuhan Listrik Lebih atau Cukup
        if($sum_gen_usage >= 0){
            //Ambil Battrai yang masih bisa menampung Listrik
            $battery_user = DB::table('battery')->where('id_users',$id)->where('residu_val','>',0)->first();
    
            if($battery_user == TRUE){
    
                $sum_elec_to_batt = $battery_user->bat_watt + $sum_gen_usage; //Sisa Listrik dalam Battery + Sisa Listrik yang diimport
    
                // Jika Jumlah Listrik Lebih Besar dari Kapasitas Tampung Battery
                if($sum_elec_to_batt > $battery_user->residu_val){
                    $kelebihan_elec = $sum_elec_to_batt - $battery_user->residu_val;
                    // Update Ke Listrik Penuh
                    $update_bat = DB::table('battery')->where('id_battery',$battery_user->id_battery)->update([
                        'bat_watt' => $battery_user->capacity,
                        'residu_val' => 0,
                    ]);
    
                    // Cari Battery Lain yang Dapat Menampung Listrik
                    $battery_user2 = DB::table('battery')->where('id_users',$id)->where('residu_val','>',0)->first(); 
                    if($battery_user2 == TRUE){
                        if($kelebihan_elec > $battery_user2->residu_val){
                            $kelebihan_elec2 = $kelebihan_elec - $battery_user2->residu_val;
                            $update_bat2 = DB::table('battery')->where('id_battery',$battery_user2->id_battery)->update([
                                'bat_watt' => $battery_user2->capacity,
                                'residu_val' => 0,
                            ]);

                            $battery_user3 = DB::table('battery')->where('id_users',$id)->where('residu_val','>',0)->first();
                            if($battery_user3 == TRUE){                                
                                if($kelebihan_elec2 > $battery_user3->residu_val){
                                    $kelebihan_elec3 = $kelebihan_elec2 - $battery_user3->residu_val;
                                    $update_bat3 = DB::table('battery')->where('id_battery',$battery_user3->id_battery)->update([
                                        'bat_watt' => $battery_user3->capacity,
                                        'residu_val' => 0,
                                    ]);
                                    RecordElecUseModel::create([
                                        'id_users'  => $id,
                                        'gen_1'     => $gen_1,
                                        'gen_2'     => $gen_2,
                                        'gen_3'     => $gen_3,
                                        'elec_usage' => $usage,
                                        'elec_export' => $kelebihan_elec3,
                                        'elec_import' => 0,
                                    ]);

                                    //redirect to indexs
                                    Alert::success('Success!', 'User Created Successfully');
                                    return back();

                                }else{
                                    $kelebihan_elec3 = $battery_user3->residu_val - $kelebihan_elec2;
                                    $residu_new3 = $battery_user3->capacity - $kelebihan_elec3;
                                    $update_bat3 = DB::table('battery')->where('id_battery',$battery_user3->id_battery)->update([
                                        'bat_watt' => $kelebihan_elec3,
                                        'residu_val' => $residu_new3,
                                    ]);
                                    // Masih Bisa Mandiri                            
                                    RecordElecUseModel::create([
                                        'id_users'     => $id,
                                        'gen_1'     => $gen_1,
                                        'gen_2'     => $gen_2,
                                        'gen_3'     => $gen_3,
                                        'elec_usage' => $usage,
                                        'elec_export' => 0,
                                        'elec_import' => 0,
                                    ]);

                                    //redirect to indexs
                                    Alert::success('Success!', 'User Created Successfully');
                                    return back();
                                }
                            }else{
                                // Jika Tidak ada Battery yang menampung Maka Export                    
                                RecordElecUseModel::create([
                                    'id_users'     => $id,
                                    'gen_1'     => $gen_1,
                                    'gen_2'     => $gen_2,
                                    'gen_3'     => $gen_3,
                                    'elec_usage' => $usage,
                                    'elec_export' => $kelebihan_elec2,
                                    'elec_import' => 0,
                                ]);

                                //redirect to indexs
                                Alert::success('Success!', 'User Created Successfully');
                                return back();
                            }
                        }else{
                            $kelebihan_elec2 = $battery_user2->residu_val - $kelebihan_elec;
                            $residu_new2 = $battery_user2->capacity - $kelebihan_elec2;
                            $update_bat2 = DB::table('battery')->where('id_battery',$battery_user2->id_battery)->update([
                                'bat_watt' => $kelebihan_elec2,
                                'residu_val' => $residu_new2,
                            ]);
                            // Masih Bisa Mandiri                            
                            RecordElecUseModel::create([
                                'id_users'     => $id,
                                'gen_1'     => $gen_1,
                                'gen_2'     => $gen_2,
                                'gen_3'     => $gen_3,
                                'elec_usage' => $usage,
                                'elec_export' => 0,
                                'elec_import' => 0,
                            ]);

                            //redirect to indexs
                            Alert::success('Success!', 'User Created Successfully');
                            return back();
                        }
    
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

                        //redirect to indexs
                        Alert::success('Success!', 'User Created Successfully');
                        return back();
                    }
    
                }else{
                    // Jika Masih Bisa Mandiri
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
                 
            }else{
                // Tidak ada Battery yang bisa menampung sama sekali
                RecordElecUseModel::create([
                    'id_users'      => $id,
                    'gen_1'         => $gen_1,
                    'gen_2'         => $gen_2,
                    'gen_3'         => $gen_3,
                    'elec_usage'    => $usage,
                    'elec_export'   => $sum_gen_usage,
                    'elec_import'   => 0,
                ]);

                //redirect to indexs
                Alert::success('Success!', 'User Created Successfully');
                return back();
            }
    
        }else{ 
            // Ini Import

            //Ambil Battrai yang masih menampung Listrik
            $battery_user_imp = DB::table('battery')->where('id_users',$id)->where('bat_watt','>',0)->first(); //Ambil listrik dari batrai yang punya listrik
            if($battery_user_imp == TRUE){
                $kurang_bat =  $battery_user_imp->bat_watt + $sum_gen_usage; //Ambil pengurangan Listrik dengan Listrik yang dibutuhkan                
                if($kurang_bat <= 0){                    
                    // Update Ke Listrik Penuh
                    $update_bat = DB::table('battery')->where('id_battery',$battery_user_imp->id_battery)->update([
                        'bat_watt' => 0,
                        'residu_val' => $battery_user_imp->capacity,
                    ]);

                    // Cari Battery Lain yang masih Menampung Listrik
                    $battery_user2_imp = DB::table('battery')->where('id_users',$id)->where('bat_watt','>',0)->first();
                    if($battery_user2_imp == TRUE){
                        $kurang_bat2 = $battery_user2_imp->bat_watt + $kurang_bat;
                        if($kurang_bat2 <= 0){
                            $update_bat2 = DB::table('battery')->where('id_battery',$battery_user2_imp->id_battery)->update([
                                'bat_watt' => 0,
                                'residu_val' => $battery_user2_imp->capacity,
                            ]);

                            $battery_user3_imp = DB::table('battery')->where('id_users',$id)->where('bat_watt','>',0)->first();
                            if($battery_user3_imp == TRUE){
                                $kurang_bat3 = $battery_user3_imp->bat_watt + $kurang_bat2;
                                if($kurang_bat3 <= 0){
                                    $update_bat3 = DB::table('battery')->where('id_battery',$battery_user3_imp->id_battery)->update([
                                        'bat_watt' => 0,
                                        'residu_val' => $battery_user3_imp->capacity,
                                    ]);

                                    RecordElecUseModel::create([
                                        'id_users'  => $id,
                                        'gen_1'     => $gen_1,
                                        'gen_2'     => $gen_2,
                                        'gen_3'     => $gen_3,
                                        'elec_usage' => $usage,
                                        'elec_export' => 0,
                                        'elec_import' => abs($kurang_bat3),
                                    ]);
                                }else{
                                    // Jika Masih Mampu
                                    $residu_batt_imp3 = $battery_user3_imp->capacity - $kurang_bat3;
                                    $update_bat3 = DB::table('battery')->where('id_battery',$battery_user3_imp->id_battery)->update([
                                        'bat_watt' => $kurang_bat3,
                                        'residu_val' => $residu_batt_imp3,
                                    ]);
                                    // Jika Tidak ada battery yang menampung listrik dan harus import
                                    RecordElecUseModel::create([
                                        'id_users'  => $id,
                                        'gen_1'     => $gen_1,
                                        'gen_2'     => $gen_2,
                                        'gen_3'     => $gen_3,
                                        'elec_usage' => $usage,
                                        'elec_export' => 0,
                                        'elec_import' => 0,
                                    ]);
                                }
                            }else{
                                // Jika Tidak ada battery yang menampung listrik dan harus import
                                RecordElecUseModel::create([
                                    'id_users'  => $id,
                                    'gen_1'     => $gen_1,
                                    'gen_2'     => $gen_2,
                                    'gen_3'     => $gen_3,
                                    'elec_usage' => $usage,
                                    'elec_export' => 0,
                                    'elec_import' => abs($kurang_bat2),
                                ]);
                            }

                        }else{
                            // Jika Masih Mampu
                            $residu_batt_imp2 = $battery_user2_imp->capacity - $kurang_bat2;                            
                            $update_bat2 = DB::table('battery')->where('id_battery',$battery_user2_imp->id_battery)->update([
                                'bat_watt' => $kurang_bat2,
                                'residu_val' => $residu_batt_imp2,
                            ]);

                            RecordElecUseModel::create([
                                'id_users'  => $id,
                                'gen_1'     => $gen_1,
                                'gen_2'     => $gen_2,
                                'gen_3'     => $gen_3,
                                'elec_usage' => $usage,
                                'elec_export' => 0,
                                'elec_import' => 0,
                            ]);
                        }
                    }else{
                        // Jika Tidak ada battery yang menampung listrik dan harus import
                        RecordElecUseModel::create([
                            'id_users'  => $id,
                            'gen_1'     => $gen_1,
                            'gen_2'     => $gen_2,
                            'gen_3'     => $gen_3,
                            'elec_usage' => $usage,
                            'elec_export' => 0,
                            'elec_import' => abs($kurang_bat),
                        ]);
                    }

                }else{
                    // Jika Listrik Masih Mampu
                    $residu_batt_imp = $battery_user_imp->capacity - $kurang_bat;
                    $update_bat = DB::table('battery')->where('id_battery',$battery_user_imp->id_battery)->update([
                        'bat_watt' => $kurang_bat,
                        'residu_val' => $residu_batt_imp,
                    ]);

                    RecordElecUseModel::create([
                        'id_users'  => $id,
                        'gen_1'     => $gen_1,
                        'gen_2'     => $gen_2,
                        'gen_3'     => $gen_3,
                        'elec_usage' => $usage,
                        'elec_export' => 0,
                        'elec_import' => 0,
                    ]);
                }

            }else{
                // Jika Tidak ada battery yang menampung listrik dan harus import
                RecordElecUseModel::create([
                    'id_users'  => $id,
                    'gen_1'     => $gen_1,
                    'gen_2'     => $gen_2,
                    'gen_3'     => $gen_3,
                    'elec_usage' => $usage,
                    'elec_export' => 0,
                    'elec_import' => abs($sum_gen_usage),
                ]);
            }

            //redirect to indexs
            Alert::success('Success!', 'User Created Successfully');
            return back();


        }
    }
}
