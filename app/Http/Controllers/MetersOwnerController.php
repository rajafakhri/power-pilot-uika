<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MetersModel;
use App\Models\BatteryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Alert;

class MetersOwnerController extends Controller
{

    public function index()
    {
        $meters = MetersModel::join('battery','meters.id_battery','battery.id_battery')
                ->join('users','battery.id_users','users.id')->select('meters.*','battery.id_battery','users.name')->latest()->paginate(5);        
        return view('owner.meters',compact('meters'));
    }
}
