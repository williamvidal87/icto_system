<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkTicketDatabase extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'request_no',
    'client_id',
    'user_office_info',
    'status_id',
    'personnel_id',
    'request_category',
    'date_approve',
    'technical_id',
    'support_id',
    'borrow_id',
    'cancel_reason'
    ];
    
    public function getStatus()
    {
        return $this->belongsTo(Status::class,'status_id')->withTrashed();
    }
    
    public function getRequestCategory()
    {
        return $this->belongsTo(RequestCategory::class,'request_category');
    }
    
    public function getClient()
    {
        return $this->belongsTo(User::class,'client_id');
    }
    
    public function getPersonnel()
    {
        return $this->belongsTo(User::class,'personnel_id');
    }
    
    public function getTechnicalID()
    {
        return $this->belongsTo(ClientTechnicalRequestDatabase::class,'technical_id');
    }
    public function getSupportID()
    {
        return $this->belongsTo(ClientITSupportServicesDatabase::class,'support_id');
    }
    public function getBorrowID()
    {
        return $this->belongsTo(ClientBorrowEquipmentRequestDatabase::class,'borrow_id');
    }
    
    
    public function getTechnicalPersonnelID()
    {
        return $this->belongsTo(ClientTechnicalRequestDatabase::class,'technical_id')->with('getPersonnelID');
    }
    public function getSupportPersonnelID()
    {
        return $this->belongsTo(ClientITSupportServicesDatabase::class,'support_id')->with('getPersonnelID');
    }
    public function getBorrowPersonnelID()
    {
        return $this->belongsTo(ClientBorrowEquipmentRequestDatabase::class,'borrow_id')->with('getPersonnelID');
    }
    
    
    public function getTechnicalClientID()
    {
        return $this->belongsTo(ClientTechnicalRequestDatabase::class,'technical_id')->with('getClientID');
    }
    public function getSupportClientID()
    {
        return $this->belongsTo(ClientITSupportServicesDatabase::class,'support_id')->with('getClientID');
    }
    public function getBorrowClientID()
    {
        return $this->belongsTo(ClientBorrowEquipmentRequestDatabase::class,'borrow_id')->with('getClientID');
    }
}
