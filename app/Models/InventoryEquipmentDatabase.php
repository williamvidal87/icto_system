<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryEquipmentDatabase extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['client_id','end_user','device_name','property_no','serial_no','specs','acquisition_date','status_id','image','qty'];
    
    public function getStatus()
    {
        return $this->belongsTo(Status::class,'status_id')->withTrashed();
    }
    public function getClient()
    {
        return $this->belongsTo(User::class,'client_id');
    }
}
