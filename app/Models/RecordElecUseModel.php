<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordElecUseModel extends Model
{
    use HasFactory;

    protected $table = "record_elec_use";
    protected $primaryKey = 'id_rec_elec_use';
    protected $fillable = ['id_users','gen_1','gen_2','gen_3','elec_usage','elec_export','elec_import','created_at','updated_at'];
}
