<?php

namespace App\Http\Livewire\AdminPanel\ManageInventory;

use App\Models\InventoryEquipmentDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class InventoryEquipmentView extends Component
{
    use WithFileUploads;

    public  $images = [];
    public  $temp_images = [];
    public  $data = [];
    public  $device_name,
            $property_no,
            $serial_no,
            $specs,
            $acquisition_date;
    public  $InventoryEquipmentID;
    public  $edit_data=0;
    public  $status_id,
            $status_check;
    
    protected $listeners = ['viewInventoryEquipment'];
    

    public function viewInventoryEquipment($InventoryEquipmentID)
    {
        $this->InventoryEquipmentID=$InventoryEquipmentID;
        $DATA=InventoryEquipmentDatabase::find($this->InventoryEquipmentID);
        $DATA->with('getStatus');
        $this->device_name = $DATA['device_name'];
        $this->property_no = $DATA['property_no'];
        $this->serial_no = $DATA['serial_no'];
        $this->specs = $DATA['specs'];
        $this->acquisition_date = $DATA['acquisition_date'];
        $this->status_id = $DATA->getStatus->status;
        $this->status_check = $DATA['status_id'];
        $this->images = $DATA['image'];
        $this->images= json_decode($this->images , true);
        $this->temp_images=$this->images;
        $this->edit_data=1;
        

    }

    public function render()
    {
        return view('livewire.admin-panel.manage-inventory.inventory-equipment-view');
    }
    
    public function setDefective()                  //for   setDefective
    {
        $this->data = ([
            'status_id'                 => 7
        ]);
        
        try {
            if($this->InventoryEquipmentID){
                $check_status=InventoryEquipmentDatabase::find($this->InventoryEquipmentID);
                if($check_status['status_id']!=$this->status_check){
                    $this->emit('alert_warning');
                    $this->emit('closeInventoryEquipmentView');
                    $this->emit('refresh_inventory_equipment_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
                InventoryEquipmentDatabase::find($this->InventoryEquipmentID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Device ID. '.'DE'.(1002039200+$this->InventoryEquipmentID).' is successfully Set Defective to Inventory Equipment',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
            }else{
            
            }
        } catch (\Exception $e) {
			dd($e);
			return back();
        }
        $this->emit('closeInventoryEquipmentView');
        $this->emit('refresh_inventory_equipment_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }
    
    public function setAvailable()                  //for   setAvailable
    {
        $this->data = ([
            'status_id'                 => 6,
            'client_id'                 => null
        ]);
        
        try {
            if($this->InventoryEquipmentID){
                $check_status=InventoryEquipmentDatabase::find($this->InventoryEquipmentID);
                if($check_status['status_id']!=$this->status_check){
                    $this->emit('alert_warning');
                    $this->emit('closeInventoryEquipmentView');
                    $this->emit('refresh_inventory_equipment_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
                InventoryEquipmentDatabase::find($this->InventoryEquipmentID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Device ID. '.'DE'.(1002039200+$this->InventoryEquipmentID).' is successfully Set Defective to Inventory Equipment',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
            }else{
            
            }
        } catch (\Exception $e) {
			dd($e);
			return back();
        }
        $this->emit('closeInventoryEquipmentView');
        $this->emit('refresh_inventory_equipment_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }
    
    
    public function closeInventoryEquipmentForm(){
        $this->emit('closeInventoryEquipmentView');
        $this->emit('refresh_inventory_equipment_table');
        $this->edit_data=0;
        $this->images = [];
        $this->temp_images = [];
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
