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

        $users = User::latest()->where('level',3)->get();
        $users_adm = User::latest()->where('level',1)->orWhere('level',2)->get();
        return view('admin.data_users.users',compact('users','users_adm'));
        // return response()->json($users);
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
            'saldo' => ['required', 'string', 'min:1'],
        ]);        

        //create post
        User::create([            
            'name'     => $request->name,
            'email'   => $request->email,
            'password'   => Hash::make($request->password),
            'saldo'   => $request->saldo,
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
            'saldo' => ['required', 'string', 'min:1'],
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
                    'level'   => $request->level,
                    'saldo'   => $request->saldo,
                ]);
            }else{                
                $users->update([
                    'name'     => $request->name,
                    'email'   => $request->email,                    
                    'level'   => $request->level,
                    'saldo'   => $request->saldo,
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

    // Proses Salah
    public function rand_watt_home($id){        
        
        $gen_1 = 600; //Generator 1
        $gen_2 = 0; //Generator 2
        $gen_3 = 0; //Generator 3
        
        $usage = 400;  //Pemakaian Listrik
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
                                        'bat_watt' => $residu_new3,
                                        'residu_val' => $kelebihan_elec3,
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
                                'bat_watt' => $residu_new2,
                                'residu_val' => $kelebihan_elec2,
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
    // End Proses Salah

    public function up_generator($id){
        $gen_1 = 5000; //Generator 1
        $gen_2 = 0; //Generator 2
        $gen_3 = 0; //Generator 3
        
        $total_gen = $gen_1 + $gen_2 + $gen_3;                        
        $battery_user = DB::table('battery')->where('id_users',$id)->where('residu_val','>',0)->get();
        if($battery_user == TRUE){
            foreach($battery_user as $battery){            
                if($total_gen >= $battery->residu_val){
                    // Jika Lebih dari Capasitas yang bisa ditampung
                    $total_gen -= $battery->residu_val;
                    if($total_gen >= 0){
                        $up_data = DB::table('battery')->where('id_users',$id)->where('id_battery',$battery->id_battery)->update([
                            'bat_watt' => $battery->capacity,
                            'residu_val' => 0,
                        ]);
                    }
                }else{
                    // Jika sudah masih ada sisa listrik namun masih bisa ditampung
                    if($total_gen > 0){                    
                        $sum_residu = $battery->capacity - $total_gen;
                        $up_data = DB::table('battery')->where('id_users',$id)->where('id_battery',$battery->id_battery)->update([
                            'bat_watt' => $total_gen,                    
                            'residu_val' => $sum_residu,                    
                            ]);
                        $total_gen -= $battery->residu_val;
                    }
                }
            }

            


            $get_sum_battery = DB::table('battery')->where('id_users',$id)->sum('bat_watt'); //Listrik dari battery (Watt)
            $sum_cap = DB::table('battery')->where('id_users',$id)->sum('capacity');
            if($sum_cap == TRUE){
                RecordElecUseModel::create([
                    'id_users'  => $id,
                    'gen_1'     => $gen_1,
                    'gen_2'     => $gen_2,
                    'gen_3'     => $gen_3,
                    'elec_usage' => 0,
                    'elec_export' => 0,
                    'elec_import' => 0,
                ]);
    
                $persentase_bat = ($get_sum_battery / $sum_cap) * 100; //Hitung Persentase
    
                $up_us_persen = DB::table('users')->where('id',$id)->update([
                    'persentase' => $persentase_bat,
                ]);
    
                //redirect to indexs
                Alert::success('Success!', 'Battery is Fully Charged');
                return back();
            }else{
                // Tidak Punya Battery
                Alert::error('Error!', 'User Has No Battery');
                return back();
            }

        }else{
            // Tidak Punya Battery
            Alert::error('Error!', 'User Has No Battery');
            return back();
        }
        
    }

    public function electric_export($id){        
        $usage = 2000; //Pemakaian (Watt)
        $get_sum_battery = DB::table('battery')->where('id_users',$id)->sum('bat_watt'); //Listrik dari battery (Watt)
        $sum_cap = DB::table('battery')->where('id_users',$id)->sum('capacity');
        $get_data_battery = DB::table('battery')->where('id_users',$id)->orderBy('bat_watt','ASC')->get();
                
        $val_export = (50 / 100) * $sum_cap; //Ambil Jumlah Watt battery 50 %
        $sum_export = $get_sum_battery - $usage - $val_export; //Hitung Kebutuhan dulu
        
        $battery_user = DB::table('battery')->where('id_users','!=',$id)->get(); 
        
        $sum_ex_utm = $sum_export + $usage;
        $isi_saldo = $sum_export;
        
        if($sum_export > 0){

            // Ambil Battery Utama Users (Ini Battery yang Export)        
            if($battery_user == TRUE){
                foreach($battery_user as $battery){
                    $check_us = DB::table('users')
                    ->where('id',$battery->id_users)->where('persentase',0)
                    ->where('saldo','>=',$sum_export)->first();

                    if($check_us == TRUE AND $check_us->saldo >= $sum_export ){
                        if($sum_export >= $battery->residu_val){
                            // Jika Lebih dari Capasitas yang bisa ditampung
                            $sum_export -= $battery->residu_val;
                            if($sum_export >= 0){
                                $up_data = DB::table('battery')->where('id_users',$battery->id_users)->where('id_battery',$battery->id_battery)->update([
                                    'bat_watt' => $battery->capacity,
                                    'residu_val' => 0,
                                ]);

                                $get_sum_battery_ex = DB::table('battery')->where('id_users',$battery->id_users)->sum('bat_watt'); //Listrik dari battery (Watt)
                                $sum_cap_ex = DB::table('battery')->where('id_users',$battery->id_users)->sum('capacity');
                                $persentase_bat_ex = ($get_sum_battery_ex / $sum_cap_ex) * 100; //Hitung Persentase                          

                                $up_us_persen_ex = DB::table('users')->where('id',$battery->id_users)->update([
                                    'saldo' => $check_us->saldo - $battery->capacity,
                                    'persentase' => $persentase_bat_ex,
                                ]);

                                RecordElecUseModel::create([
                                    'id_users'  => $id,
                                    'gen_1'     => 0,
                                    'gen_2'     => 0,
                                    'gen_3'     => 0,
                                    'elec_usage' => $usage,
                                    'elec_export' => $sum_export,
                                    'elec_import' => 0,
                                    'export_to' => $battery->id_users,
                                ]);
                            }
                        }else{
                            // Jika sudah masih ada sisa listrik namun masih bisa ditampung
                            if($sum_export > 0){                    
                                $sum_residu = $battery->capacity - $sum_export;
                                $up_data = DB::table('battery')->where('id_users',$battery->id_users)->where('id_battery',$battery->id_battery)->update([
                                    'bat_watt' => $sum_export,                    
                                    'residu_val' => $sum_residu,                    
                                    ]);

                                    $get_sum_battery_ex = DB::table('battery')->where('id_users',$battery->id_users)->sum('bat_watt'); //Listrik dari battery (Watt)
                                    $sum_cap_ex = DB::table('battery')->where('id_users',$battery->id_users)->sum('capacity');
                                    $persentase_bat_ex = ($get_sum_battery_ex / $sum_cap_ex) * 100; //Hitung Persentase

                                    $up_us_persen_ex = DB::table('users')->where('id',$battery->id_users)->update([
                                        'saldo' => $check_us->saldo - $sum_export,
                                        'persentase' => $persentase_bat_ex,
                                    ]);

                                    RecordElecUseModel::create([
                                        'id_users'  => $id,
                                        'gen_1'     => 0,
                                        'gen_2'     => 0,
                                        'gen_3'     => 0,
                                        'elec_usage' => $usage,
                                        'elec_export' => $sum_export,
                                        'elec_import' => 0,
                                        'export_to' => $battery->id_users,
                                    ]);
                                $sum_export -= $battery->residu_val;
                            }
                        }
                    }
                }
                

                foreach($get_data_battery as $battery_utm){
                    if($sum_ex_utm >= $battery_utm->bat_watt){
                        // Jika Lebih dari Capasitas yang bisa ditampung
                        $sum_ex_utm -= $battery_utm->bat_watt;
                        if($sum_ex_utm >= 0){
                            $up_data = DB::table('battery')->where('id_users',$id)->where('id_battery',$battery_utm->id_battery)->update([
                                'bat_watt' => 0,
                                'residu_val' => $battery_utm->capacity,
                            ]);
                        }
                    }else{
                        // Jika sudah masih ada sisa listrik namun masih bisa ditampung
                        if($sum_ex_utm > 0){                    
                            $sum_bat_utm = $battery_utm->bat_watt - $sum_ex_utm;
                            $res_awal = $sum_ex_utm + $battery_utm->residu_val;
                            $up_data = DB::table('battery')->where('id_users',$id)->where('id_battery',$battery_utm->id_battery)->update([
                                'bat_watt' => $sum_bat_utm,                    
                                'residu_val' => $res_awal,
                                ]);
                            $sum_ex_utm -= $battery_utm->bat_watt;
                        }
                    }
                }

                if($sum_export > 0){
                    foreach($get_data_battery as $battery_utm_2){            
                        if($sum_export >= $battery_utm_2->residu_val){
                            // Jika Lebih dari Capasitas yang bisa ditampung
                            $sum_export -= $battery_utm_2->residu_val;
                            if($sum_export >= 0){
                                $up_data = DB::table('battery')->where('id_users',$id)->where('id_battery',$battery_utm_2->id_battery)->update([
                                    'bat_watt' => $battery_utm_2->capacity,
                                    'residu_val' => 0,
                                ]);
                            }
                        }else{
                            // Jika sudah masih ada sisa listrik namun masih bisa ditampung
                            if($sum_export > 0){                    
                                $sum_residu = $battery_utm_2->capacity - $sum_export;
                                $up_data = DB::table('battery')->where('id_users',$id)->where('id_battery',$battery_utm_2->id_battery)->update([
                                    'bat_watt' => $sum_export,                    
                                    'residu_val' => $sum_residu,                    
                                    ]);
                                $sum_export -= $battery_utm_2->residu_val;
                            }
                        }
                    }
                }

                // Utama
                $get_sum_battery_utm = DB::table('battery')->where('id_users',$id)->sum('bat_watt'); //Listrik dari battery (Watt)
                $sum_cap_utm = DB::table('battery')->where('id_users',$id)->sum('capacity');
                $persentase_bat_utm = ($get_sum_battery_utm / $sum_cap_utm) * 100; //Hitung Persentase
                $saldo_now = DB::table('users')->where('id',$id)->sum('saldo'); //Hitung Saldo Sekarang
                $sum_saldo = $saldo_now + $isi_saldo;

                $up_us_persen = DB::table('users')->where('id',$id)->update([
                    'saldo' => $sum_saldo,
                    'persentase' => $persentase_bat_utm,
                ]);

                //redirect to indexs
                Alert::success('Success!', 'Successfully Exported');
                return back();                            
                
            }else{
                // Tidak Punya Battery
                Alert::error('Error!', 'No Battery to export');
                return back();
            }

        }else{
            // Tidak Punya Battery
            Alert::warning('Warning!', 'Usage Reduces Battery < 50%, So Cannot Export');
            return back();
        }

    }

    public function electric_import($id){
        $usage = 3000;
        $cek_saldo = DB::table('users')->where('id',$id)->where('saldo','>',0)->first();
        if($cek_saldo == TRUE){
            $user_imp = DB::table('users')->where('id','!=',$id)->where('persentase','>',50)->get();
            if($user_imp == TRUE){ //Cek User yang battery nya lebih dari 50 %
                foreach($user_imp as $us_import){                                        
                    // Hitung berapa mampunya user ini mengimport listrik
                    $total_import_accept = $us_import->persentase - 50; //Hitung Berapa Persen bisa import
                    $sum_cap = DB::table('battery')->where('id_users',$us_import->id)->sum('capacity'); // Hitung Kapasitas User untuk mendapatkan listrik dibattery user import
                    $persentase_to_elect = ($total_import_accept / 100) * $sum_cap; //Ambil Jumlah Watt battery dari users yang bisa diimport
                    $get_bat_us_imp = DB::table('battery')->where('id_users',$us_import->id)->where('bat_watt','>',0)->get(); //Data Battery Orang lain
                    foreach($get_bat_us_imp as $bat_import){
                        $recheck_saldo = DB::table('users')->where('id',$id)->first();                                    
                        $data_saldo = $recheck_saldo->saldo;                        
                        if($data_saldo > 0){
                            // Jika Saldo Lebih besar dari Listrik yang diimport
                            if($data_saldo >= $persentase_to_elect){
                                $import_to_user = DB::table('battery')->where('id_users',$id)->where('residu_val','>',0)->first();
                                if($import_to_user == TRUE AND $persentase_to_elect >= $import_to_user->residu_val){
                                    $update_imp_1 = DB::table('battery')->where('id_users',$import_to_user->id_users)
                                    ->where('id_battery',$import_to_user->id_battery)
                                    ->update([
                                        'bat_watt' => $import_to_user->residu_val,
                                        'residu_val' => $import_to_user->capacity - $import_to_user->residu_val,
                                    ]);

                                    $sum_bat_up = DB::table('battery')->where('id_users',$import_to_user->id_users)->sum('bat_watt');
                                    $sum_cap_up = DB::table('battery')->where('id_users',$import_to_user->id_users)->sum('capacity');
                                    $get_persentase_new = ($sum_bat_up / $sum_cap_up) * 100;
                                    
                                    $saldo_new = $data_saldo - $import_to_user->residu_val;

                                    $up_to_us = DB::table('users')->where('id',$import_to_user->id_users)->update([
                                        'persentase' => $get_persentase_new,
                                        'saldo' => $saldo_new,
                                    ]);

                                    // User yang Saldonya bertambah & Listrik Berkurang                                    
                                    $update_imp_2 = DB::table('battery')->where('id_users',$bat_import->id_users)
                                    ->where('id_battery',$bat_import->id_battery)
                                    ->update([
                                        'bat_watt' => $bat_import->bat_watt - $import_to_user->residu_val,
                                        'residu_val' => $import_to_user->capacity - $bat_import->residu_val,
                                    ]);

                                    $sum_bat_up_1 = DB::table('battery')->where('id_users',$bat_import->id_users)->sum('bat_watt');
                                    $sum_cap_up_1 = DB::table('battery')->where('id_users',$bat_import->id_users)->sum('capacity');
                                    $get_persentase_new_1 = ($sum_bat_up_1 / $sum_cap_up_1) * 100;

                                    $recheck_saldo = DB::table('users')->where('id',$bat_import->id_users)->first();

                                    $up_to_us_2 = DB::table('users')->where('id',$bat_import->id_users)->update([
                                        'persentase' => $get_persentase_new_1,
                                        'saldo' => $recheck_saldo->saldo + $import_to_user->residu_val,
                                    ]);

                                    RecordElecUseModel::create([
                                        'id_users'  => $id,
                                        'gen_1'     => 0,
                                        'gen_2'     => 0,
                                        'gen_3'     => 0,
                                        'elec_usage' => $usage,                                    
                                        'elec_import' => $import_to_user->residu_val,
                                        'import_from' => $bat_import->id_users,
                                    ]);
                                    
                                    $data_saldo -= $import_to_user->residu_val;                                    
                                    $persentase_to_elect -= $import_to_user->residu_val;


                                }elseif($import_to_user == TRUE AND $persentase_to_elect < $import_to_user->residu_val AND $persentase_to_elect > 0){
                                    $update_imp_1 = DB::table('battery')->where('id_users',$import_to_user->id_users)
                                    ->where('id_battery',$import_to_user->id_battery)
                                    ->update([
                                        'bat_watt' => $persentase_to_elect,
                                        'residu_val' => $import_to_user->capacity - $persentase_to_elect,
                                    ]);
                                    
                                    $sum_bat_up = DB::table('battery')->where('id_users',$import_to_user->id_users)->sum('bat_watt');
                                    $sum_cap_up = DB::table('battery')->where('id_users',$import_to_user->id_users)->sum('capacity');
                                    $get_persentase_new = ($sum_bat_up / $sum_cap_up) * 100;

                                    $saldo_new2 = $data_saldo - $persentase_to_elect;

                                    $up_to_us = DB::table('users')->where('id',$import_to_user->id_users)->update([
                                        'persentase' => $get_persentase_new,
                                        'saldo' => $saldo_new2,
                                    ]);

                                    // User yang Saldonya bertambah & Listrik Berkurang                                    
                                    $update_imp_2 = DB::table('battery')->where('id_users',$bat_import->id_users)
                                    ->where('id_battery',$bat_import->id_battery)
                                    ->update([
                                        'bat_watt' => $bat_import->bat_watt - $persentase_to_elect,
                                        'residu_val' => $bat_import->residu_val + $persentase_to_elect,
                                    ]);

                                    $sum_bat_up_1 = DB::table('battery')->where('id_users',$bat_import->id_users)->sum('bat_watt');
                                    $sum_cap_up_1 = DB::table('battery')->where('id_users',$bat_import->id_users)->sum('capacity');
                                    $get_persentase_new_1 = ($sum_bat_up_1 / $sum_cap_up_1) * 100;

                                    $recheck_saldo = DB::table('users')->where('id',$bat_import->id_users)->first();

                                    $up_to_us_2 = DB::table('users')->where('id',$bat_import->id_users)->update([
                                        'persentase' => $get_persentase_new_1,
                                        'saldo' => $recheck_saldo->saldo + $persentase_to_elect,
                                    ]);

                                    RecordElecUseModel::create([
                                        'id_users'  => $id,
                                        'gen_1'     => 0,
                                        'gen_2'     => 0,
                                        'gen_3'     => 0,
                                        'elec_usage' => $usage,                                    
                                        'elec_import' => $bat_import->bat_watt - $persentase_to_elect,
                                        'import_from' => $bat_import->id_users,
                                    ]);
                                    
                                    $data_saldo -= $persentase_to_elect;                                    
                                    $persentase_to_elect -= $persentase_to_elect;
                                }                                                            

                            }else{
                                // Jika Saldo Sudah Tidak Cukup Tapi Telah terjadi Import Sebelumnyay                                
                            }
                            
                        }else{
                            // Jika Saldo Tidak ada
                        }
                    }
                }
            }else{
                // Jika tidak ada user yang listriknya lebih dari 50 %
            }
            
            $get_us_bat_new = DB::table('battery')->where('id_users',$id)->get();
            $get_sum_battery_new = DB::table('battery')->where('id_users',$id)->sum('bat_watt');

            if($get_us_bat_new == TRUE AND $get_sum_battery_new >= $usage){
                foreach($get_us_bat_new as $us_bat_new){
                    if($usage > 0){
                        if($usage >= $us_bat_new->bat_watt){
                            $up_usage_bat = DB::table('battery')->where('id_users',$id)->where('id_battery',$us_bat_new->id_battery)->update([
                                'bat_watt' => 0,
                                'residu_val' => $us_bat_new->capacity,
                            ]);                            
                            $usage -= $us_bat_new->capacity;
                        }else{
                            // Jika Pemakaian kurang dari Battery yang ada                            
                            $residu_val_new = $us_bat_new->capacity - ($us_bat_new->bat_watt - $usage);
                            $up_usage_bat = DB::table('battery')->where('id_users',$id)->where('id_battery',$us_bat_new->id_battery)->update([
                                'bat_watt' => $us_bat_new->bat_watt - $usage,
                                'residu_val' => $residu_val_new,
                            ]);

                            $usage -= $us_bat_new->bat_watt;
                        }                        
                    }

                    $sum_bat_have = DB::table('battery')->where('id_users',$id)->sum('bat_watt');
                    $sum_cap_have = DB::table('battery')->where('id_users',$id)->sum('capacity');
                    $get_persentase_have = ($sum_bat_have / $sum_cap_have) * 100;                        

                    $up_to_us_have = DB::table('users')->where('id',$id)->update([
                        'persentase' => $get_persentase_have,                            
                    ]);  
                }

                //redirect to indexs
                Alert::success('Success!', 'Imported Successfully');
                return back(); 
                
            }else{
                // Jika Battery Tidak Cukup dengan Pemakaian
                Alert::warning('Warning!', 'Import successfully but battery is not enough with usage');
                return back();
            }            

        }else{
            // Tidak Punya Saldo
            Alert::error('Error!', 'You have no balance');
            return back();
        }

    }
}
