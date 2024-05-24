<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::id())
        {
            $usertype = Auth()->user()->level;

            if($usertype == 1){
                return view('dashboard');
            }elseif($usertype == 2){
                return view('owner.dashboard');
            }elseif($usertype == 3){
                // return view('dashboard');
            }else{
                return redirect()->back();
            }
        }
    }

    public function post(){
        return view('post');
    }
}
