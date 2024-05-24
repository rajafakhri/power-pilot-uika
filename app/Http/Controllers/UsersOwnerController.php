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

class UsersOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(5);        
        return view('owner.users',compact('users'));
    }
}
