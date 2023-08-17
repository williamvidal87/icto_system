<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ITSupportServiceEquipmentsUsedDatabase extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['used_id','item_id','itemdes_id','qty'];
    
    public function getItemName()
    {
        return $this->belongsTo(EquipmentSeviceDatabase::class,'item_id')->withTrashed();
    }
    public function getClient()
    {
        return $this->belongsTo(ClientITSupportServicesDatabase::class,'used_id')->with('getClientID');
    }
}
