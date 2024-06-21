<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Alert;


class HomeController extends Controller
{
    public function index(){
        if(Auth::id())
        {
            $usertype = Auth()->user()->level;

            if($usertype == 1){
                $record_usage = DB::table('record_elec_use')->groupBy('created_at')->get();
                return view('dashboard');
            }elseif($usertype == 2){
                return view('owner.dashboard');
            }elseif($usertype == 3){                
                return view('users.home_us');
            }else{
                return redirect()->back();
            }
        }
    }

    public function post(){
        return view('post');
    }
}
