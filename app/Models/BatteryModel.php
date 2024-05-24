<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatteryModel extends Model
{
    use HasFactory;

    protected $table = "battery";
    // protected $primaryKey = 'id_battery';
    protected $fillable = ['id_battery','id_users','nm_battery','capacity','created_at','updated_at'];
}
