<?php

namespace App\Http\Livewire\AdminPanel\ManageInventory;

use App\Models\EquipmentDescriptionDatabase;
use App\Models\EquipmentSeviceDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServicesEquipmentForm extends Component
{
    use WithFileUploads;

    public  $data = [];
    public  $equipment_type_id,
            $description;
    public  $ServicesEquipmentID;
    public  $edit_data=0;
    public  $status_id;
    
    protected $listeners = ['editServicesEquipment'];
    
    public function store()
    {
        $this->validate([
            'description' => 'required',
            'equipment_type_id' => 'required',
        ]);
        
        
        $this->data = ([
            'description'               => $this->description,
            'equipment_type_id'         => $this->equipment_type_id

        
        ]);
        // dd($this->ServicesEquipmentID);

        try {
            if($this->ServicesEquipmentID){
                EquipmentDescriptionDatabase::find($this->ServicesEquipmentID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Services ID. '.(400+$this->ServicesEquipmentID).' is successfully Updated to Services',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
            }else{
                $this->data['status_id']=6;
                $show=EquipmentDescriptionDatabase::create($this->data);
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Services ID. '.(400+$show['id']).' is successfully Store to Services',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);
            }
            // ClientTechnicalRequestDatabase::create($this->data);
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->emit('closeServicesEquipmentModal');
        $this->emit('refresh_services_equipment_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }

    public function editServicesEquipment($ServicesEquipmentID)
    {
        $this->ServicesEquipmentID=$ServicesEquipmentID;
        $DATA=EquipmentDescriptionDatabase::find($this->ServicesEquipmentID);
        $this->description = $DATA['description'];
        $this->equipment_type_id = $DATA['equipment_type_id'];
        $this->status_id = $DATA['status_id'];
        $this->edit_data=1;
        

    }

    public function render()
    {
        return view('livewire.admin-panel.manage-inventory.services-equipment-form',[
            'select_equipment_type' => EquipmentSeviceDatabase::all(),
        ]);
    }
    
    
    public function closeServicesEquipmentForm(){
        $this->emit('closeServicesEquipmentModal');
        $this->emit('refresh_services_equipment_table');
        $this->edit_data=0;
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
