<?php

namespace App\Http\Livewire\AdminPanel\ManageInventory;

use App\Models\InventoryEquipmentDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class InventoryEquipmentForm extends Component
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
    public  $status_id;
    
    protected $listeners = ['editInventoryEquipment'];
    
    public function store()
    {
        $this->validate([
            'images.*' => 'max:102400', // 1MB Max
            'device_name' => 'required'
        ]);
        
        if($this->temp_images!=$this->images){
            foreach ($this->images as $key => $image) {
                $this->images[$key] = $image->store('images');
            }
        }
        
        $this->images = json_encode($this->images);
        
        $this->data = ([
            'image'                     => $this->images,
            'device_name'               => $this->device_name,
            'property_no'               => $this->property_no,
            'serial_no'                 => $this->serial_no,
            'specs'                     => $this->specs,
            'acquisition_date'          => $this->acquisition_date

        
        ]);
        
        try {
            if($this->InventoryEquipmentID){
                $check_status=InventoryEquipmentDatabase::find($this->InventoryEquipmentID);
                if($check_status['status_id']!=$this->status_id){
                    $this->emit('alert_warning');
                    $this->images = [];
                    $this->temp_images = [];
                    $this->emit('closeInventoryEquipmentModal');
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
                    'activity'      =>  'This Device ID. '.'DE'.(1002039200+$this->InventoryEquipmentID).' is successfully Updated to Inventory Equipment',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
            }else{
                $this->data['status_id']=6;
                $show=InventoryEquipmentDatabase::create($this->data);
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Device ID. '.'DE'.(1002039200+$show['id']).' is successfully Store to Inventory Equipment',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);
            }
            // InventoryEquipmentDatabase::create($this->data);
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->images = [];
        $this->temp_images = [];
        $this->emit('closeInventoryEquipmentModal');
        $this->emit('refresh_inventory_equipment_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }

    public function editInventoryEquipment($InventoryEquipmentID)
    {
        $this->InventoryEquipmentID=$InventoryEquipmentID;
        $DATA=InventoryEquipmentDatabase::find($this->InventoryEquipmentID);
        $this->device_name = $DATA['device_name'];
        $this->property_no = $DATA['property_no'];
        $this->serial_no = $DATA['serial_no'];
        $this->specs = $DATA['specs'];
        $this->acquisition_date = $DATA['acquisition_date'];
        $this->status_id = $DATA['status_id'];
        $this->images = $DATA['image'];
        $this->images= json_decode($this->images , true);
        $this->temp_images=$this->images;
        $this->edit_data=1;
        

    }

    public function render()
    {
        return view('livewire.admin-panel.manage-inventory.inventory-equipment-form');
    }
    
    
    public function closeInventoryEquipmentForm(){
        $this->emit('closeInventoryEquipmentModal');
        $this->emit('refresh_inventory_equipment_table');
        $this->edit_data=0;
        $this->images = [];
        $this->temp_images = [];
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
