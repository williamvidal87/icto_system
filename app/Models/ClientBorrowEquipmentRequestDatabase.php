<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientBorrowEquipmentRequestDatabase extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['user_office_info','purpose','status_id','image','letter','personnel_id','client_id','cancel_reason'];
    
    public function getStatus()
    {
        return $this->belongsTo(Status::class,'status_id')->withTrashed();
    }
    
    public function getPersonnelID()
    {
        return $this->belongsTo(User::class,'personnel_id');
    }
    public function getClientID()
    {
        return $this->belongsTo(User::class,'client_id');
    }
}
