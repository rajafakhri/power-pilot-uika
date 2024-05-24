<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BatteryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Alert;

class BatteryOwnerController extends Controller
{
    public function index()
    {
        $battery = BatteryModel::latest()->paginate(5);        
        return view('owner.battery',compact('battery'));
    }
}
