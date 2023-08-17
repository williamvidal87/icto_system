<?php

namespace App\Http\Livewire\AdminPanel\ManageInventory;

use App\Models\InventoryEquipmentDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InventoryEquipment extends Component
{
    protected $listeners = [
        'refresh_inventory_equipment_table' => '$refresh',
        'delete',
        'closedelete'
    
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-inventory.inventory-equipment',[
            'Inventory_Equipment_Data' => InventoryEquipmentDatabase::all()
            ])->with('getStatus','getClient');
    }

    public function createInventoryEquipment(){
        $this->emit('openInventoryEquipmentModal');
    }

    public function editInventoryEquipment($InventoryEquipmentID){
        $this->emit('openInventoryEquipmentModal');
        $this->emit('editInventoryEquipment',$InventoryEquipmentID);
    }
    
    public function openInventoryView($InventoryEquipmentID){
        $this->emit('openInventoryEquipmentView');
        $this->emit('viewInventoryEquipment',$InventoryEquipmentID);
    }

    public function deleteInventoryEquipment($InventoryEquipmentID){
        $this->emit('openDeleteConfirmInventoryEquipmentModal');
        $this->emit('deleteAllAroundData',$InventoryEquipmentID);
        // InventoryEquipmentDatabase::destroy($this->InventoryEquipmentID);
    }

    public function delete($InventoryEquipmentID){
        InventoryEquipmentDatabase::destroy($InventoryEquipmentID);
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Device ID. '.'DE'.(1001339700+$InventoryEquipmentID).' is successfully Deleted to Inventory Equipment',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
    public function closedelete(){
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
    }
}
