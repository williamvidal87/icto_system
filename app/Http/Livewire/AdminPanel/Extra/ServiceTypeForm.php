<?php

namespace App\Http\Livewire\AdminPanel\Extra;

use App\Models\EquipmentSeviceDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServiceTypeForm extends Component
{
    use WithFileUploads;

    public  $data = [];
    public  $equipment_name;
    public  $ServiceTypeID;
    public  $edit_data=0;
    public  $status_id;
    
    protected $listeners = ['editServiceType'];
    
    public function store()
    {
        $this->validate([
            'equipment_name' => 'required',
        ]);
        
        $this->data = ([
            'equipment_name'          => $this->equipment_name,

        
        ]);

        try {
            if($this->ServiceTypeID){
                EquipmentSeviceDatabase::find($this->ServiceTypeID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This ID.'.(200+$this->ServiceTypeID).' is successfully Updated to Service Type',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
            }else{
                $this->data['client_id']=Auth::user()->id;
                $this->data['status_id']=1;
                $show=EquipmentSeviceDatabase::create($this->data);
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This ID.'.(200+$show['id']).' is successfully Store to Service Type',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);
            }
            // ClientServiceTypeDatabase::create($this->data);
        } catch (\Exception $e) {
			dd($e);
			return back();
        }
        $this->emit('closeServiceTypeModal');
        $this->emit('refresh_service_type_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }

    public function editServiceType($ServiceTypeID)
    {
        $this->ServiceTypeID=$ServiceTypeID;
        $DATA=EquipmentSeviceDatabase::find($this->ServiceTypeID);
        $this->equipment_name = $DATA['equipment_name'];
        $this->edit_data=1;
        

    }

    public function render()
    {
        return view('livewire.admin-panel.extra.service-type-form');
    }
    
    
    public function closeServiceTypeForm(){
        $this->emit('closeServiceTypeModal');
        $this->emit('refresh_service_type_table');
        $this->edit_data=0;
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
