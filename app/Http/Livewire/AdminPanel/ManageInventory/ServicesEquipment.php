<?php

namespace App\Http\Livewire\AdminPanel\ManageInventory;

use App\Models\ClientTechnicalRequestDatabase;
use App\Models\EquipmentDescriptionDatabase;
use App\Models\ITSupportServiceEquipmentsUsedDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ServicesEquipment extends Component
{
    protected $listeners = [
        'refresh_services_equipment_table' => '$refresh',
        'delete',
        'closedelete'
    
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-inventory.services-equipment',[
            'Equipments' => EquipmentDescriptionDatabase::all(),
            'Equipment_User' => ITSupportServiceEquipmentsUsedDatabase::all()
            ])->with('getStatus','getEquipementType');
    }

    public function createServicesEquipment(){
        $this->emit('openServicesEquipmentModal');
    }

    public function editServicesEquipment($ServicesEquipmentID){
        $this->emit('openServicesEquipmentModal');
        $this->emit('editServicesEquipment',$ServicesEquipmentID);
    }
    
    public function openServicesEquipment($ServicesEquipmentID){
        $this->emit('openServicesEquipemntView');
        $this->emit('viewServicesEquipment',$ServicesEquipmentID);
    }

    public function deleteServicesEquipment($ServicesEquipmentID){
        $this->emit('openDeleteConfirmServicesEquipemntModal');
        $this->emit('deleteAllAroundData',$ServicesEquipmentID);
        // ClientTechnicalRequestDatabase::destroy($this->ServicesEquipmentID);
    }

    public function delete($ServicesEquipmentID){
        EquipmentDescriptionDatabase::destroy($ServicesEquipmentID);
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Services ID. '.(400+$ServicesEquipmentID).' is successfully Deleted to Services',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
    public function closedelete(){
        $this->emit('closeDeleteConfirmTechnicalRequestModal');
        $this->emit('EmitTable');
    }
}
