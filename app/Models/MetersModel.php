<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetersModel extends Model
{
    use HasFactory;

    protected $table = "meters";
    protected $primaryKey = 'id_meters';
    protected $fillable = ['nm_meters','m_volt','m_ampere','m_watt','id_battery','created_at','updated_at'];
}
