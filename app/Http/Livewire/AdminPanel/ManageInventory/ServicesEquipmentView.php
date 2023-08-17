<?php

namespace App\Http\Livewire\AdminPanel\ManageInventory;

use App\Models\EquipmentDescriptionDatabase;
use App\Models\EquipmentSeviceDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServicesEquipmentView extends Component
{
    use WithFileUploads;

    public  $data = [];
    public  $equipment_type_id,
            $description;
    public  $ServicesEquipmentID;
    public  $edit_data=0;
    public  $status_id,
            $status_check;
    
    protected $listeners = ['viewServicesEquipment'];
    

    public function viewServicesEquipment($ServicesEquipmentID)
    {
        $this->ServicesEquipmentID=$ServicesEquipmentID;
        $DATA=EquipmentDescriptionDatabase::find($this->ServicesEquipmentID);
        $DATA->with('getStatus');
        $this->description = $DATA['description'];
        $this->equipment_type_id = $DATA['equipment_type_id'];
        $this->status_id = $DATA->getStatus->status;
        $this->status_check = $DATA['status_id'];
        $this->edit_data=1;
        

    }

    public function render()
    {
        return view('livewire.admin-panel.manage-inventory.services-equipment-view',[
            'select_equipment_type' => EquipmentSeviceDatabase::withTrashed()->get(),
        ]);
    }
    
    public function setNotAvailableServices()
    {
        $this->data = ([
            'status_id'                 => 11
        ]);
        
        try {
            if($this->ServicesEquipmentID){
                $check_status=EquipmentDescriptionDatabase::find($this->ServicesEquipmentID);
                if($check_status['status_id']!=$this->status_id){
                    $this->emit('alert_warning');
                    $this->emit('closeServicesEquipmentView');
                    $this->emit('refresh_services_equipment_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
                EquipmentDescriptionDatabase::find($this->ServicesEquipmentID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Services ID. '.(400+$this->ServicesEquipmentID).' is successfully Set Not Available to Services',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
            }else{
            
            }
        } catch (\Exception $e) {
			dd($e);
			return back();
        }
        $this->emit('closeServicesEquipmentView');
        $this->emit('refresh_services_equipment_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }
    
    public function setAvailableServices()
    {
        $this->data = ([
            'status_id'                 => 6
        ]);
        
        try {
            if($this->ServicesEquipmentID){
                $check_status=EquipmentDescriptionDatabase::find($this->ServicesEquipmentID);
                if($check_status['status_id']!=$this->status_check){
                    $this->emit('alert_warning');
                    $this->emit('closeServicesEquipmentView');
                    $this->emit('refresh_services_equipment_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
                EquipmentDescriptionDatabase::find($this->ServicesEquipmentID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Services ID. '.(400+$this->ServicesEquipmentID).' is successfully Set Available to Services',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
            }else{
            
            }
        } catch (\Exception $e) {
			dd($e);
			return back();
        }
        $this->emit('closeServicesEquipmentView');
        $this->emit('refresh_services_equipment_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }
    
    
    public function closeServicesEquipmentView(){
        $this->emit('closeServicesEquipmentView');
        $this->emit('refresh_services_equipment_table');
        $this->edit_data=0;
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
