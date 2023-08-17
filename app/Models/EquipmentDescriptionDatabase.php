<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentDescriptionDatabase extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['client_id','equipment_type_id','description','status_id'];
    
    public function getStatus()
    {
        return $this->belongsTo(Status::class,'status_id')->withTrashed();
    }
    public function getEquipementType()
    {
        return $this->belongsTo(EquipmentSeviceDatabase::class,'equipment_type_id')->withTrashed();
    }
}
