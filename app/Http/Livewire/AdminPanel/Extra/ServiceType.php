<?php

namespace App\Http\Livewire\AdminPanel\Extra;

use App\Models\EquipmentSeviceDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ServiceType extends Component
{
    protected $listeners = [
        'refresh_service_type_table' => '$refresh',
        'delete',
        'closedelete'
    
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.extra.service-type',[
            'ServiceTypeData' => EquipmentSeviceDatabase::all()
            ]);
    }

    public function createServiceType(){
        $this->emit('openServiceTypeModal');
    }

    public function editServiceType($ServiceTypeID){
        $this->emit('openServiceTypeModal');
        $this->emit('editServiceType',$ServiceTypeID);
    }

    public function deleteServiceType($ServiceTypeID){
        $this->emit('openDeleteConfirmServiceTypeModal');
        $this->emit('deleteAllAroundData',$ServiceTypeID);
    }

    public function delete($ServiceTypeID){
        EquipmentSeviceDatabase::destroy($ServiceTypeID);
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This ID.'.(200+$ServiceTypeID).' is successfully Deleted to Service Type',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
    public function closedelete(){
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
    }
}
