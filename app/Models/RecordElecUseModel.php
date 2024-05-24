<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordElecUseModel extends Model
{
    use HasFactory;

    protected $table = "record_elec_use";
    protected $primaryKey = 'id_rec_elec_use';
    protected $fillable = ['id_users','battery_watt','watt_hour','use_kwh','created_at','updated_at'];
}
