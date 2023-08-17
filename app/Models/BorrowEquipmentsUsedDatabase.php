<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowEquipmentsUsedDatabase extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['used_id','device_id','qty'];

    public function getItemName()
    {
        return $this->belongsTo(InventoryEquipmentDatabase::class,'device_id')->withTrashed();
    }
}
