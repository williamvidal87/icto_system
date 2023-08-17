<?php

namespace App\Http\Livewire\ClientPanel\RequestTechServices;

use App\Models\ClientITSupportServicesDatabase;
use App\Models\EquipmentDescriptionDatabase;
use App\Models\EquipmentSeviceDatabase;
use App\Models\ITSupportServiceEquipmentsUsedDatabase;
use Livewire\Component;
use Livewire\WithFileUploads;

class ITSupportServicesView extends Component
{
    use WithFileUploads;
 
    public  $letters = [];
    public  $temp_letters = [];
    public  $data = [];
    public  $request_no,
            $person_incharge,
            $event_information,
            $schedule,
            $status_id,
            $status_check,
            $cancel_reason;
    public  $ITSupportServicesRequestID;
    public  $edit_data=0;

    // sample
        public  $orderProducts = [];
        public  $item_id = [];
        public  $itemdes_id = [];
        public  $count = 0;
        public  $count2 = 0;

        

        public function addProduct()
        
    {
        $this->orderProducts[] = ['equipment_id'=>'','item_id'=>'','used_id' => '', 'itemdes_id' => ''];
    }

    public function removeProduct($index)
    {   
        // dd($this->orderProducts[$index]['equipment_id']);
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }
    
    // end sample
    
    protected $listeners = ['openITSupportServicesView'];

    public function store()
    {
        $this->validate([
            'letters.*' => 'max:102400', // 1MB Max
            'person_incharge' => 'required',
            'event_information' => 'required',
            'schedule' => '',
        ]);
        
        if($this->temp_letters!=$this->letters){
            foreach ($this->letters as $key => $letter) {
                $this->letters[$key] = $letter->store('letters');
            }
        }
        
        $this->letters = json_encode($this->letters);
        
        $this->data = ([
            'letter'                        => $this->letters,
            'person_incharge'               => $this->person_incharge,
            'event_information'             => $this->event_information,
            'schedule'                      => $this->schedule,

        
        ]);
        
        $this->data['status_id']=1;

        try {
            if($this->ITSupportServicesRequestID){
                // dd(count($this->orderProducts));
                ClientITSupportServicesDatabase::find($this->ITSupportServicesRequestID)->update($this->data); 
                $search_sample=ITSupportServiceEquipmentsUsedDatabase::where('used_id',$this->ITSupportServicesRequestID)->get();
                $this->count=0;

                // for empty items
                if(count($this->orderProducts)==0){
                    foreach ($search_sample as $search_samp2){
                        ITSupportServiceEquipmentsUsedDatabase::destroy($search_samp2['id']);
                    }
                }


                foreach ($search_sample as $search_samp){
                    $search[$this->count]=$search_samp;
                    
                $this->count2=0;
                foreach ($this->orderProducts as $key4) {
                    if($key4['equipment_id']=="")
                    {
                    }else{
                        if($search[$this->count]['id']==$key4['equipment_id']){
                        }else{
                            $this->count2++;
                            if($this->count2==count($this->orderProducts)){
                                // dd($this->count2);
                                ITSupportServiceEquipmentsUsedDatabase::destroy($search[$this->count]['id']);
                            }
                        }
                    }
                }
                    
                    $this->count++;
                }
                $this->count=0;
                foreach ($this->orderProducts as $key3) {
                    // dd($key3);
                    if($key3['equipment_id']=="")
                    {
                        ITSupportServiceEquipmentsUsedDatabase::create(['used_id' => $this->ITSupportServicesRequestID,'item_id' => $key3['item_id'], 'itemdes_id' => $key3['itemdes_id']]);
                    }else{
                        ITSupportServiceEquipmentsUsedDatabase::find($this->orderProducts[$this->count]['equipment_id'])->update($this->orderProducts[$this->count]);
                        $this->count++;
                    }
                }
                $this->emit('alert_update');
            }else{
                $show=ClientITSupportServicesDatabase::create($this->data);
                
                foreach ($this->orderProducts as $key2) {
                    
                    ITSupportServiceEquipmentsUsedDatabase::create(['used_id' => $show['id'],'item_id' => $key2['item_id'], 'itemdes_id' => $key2['itemdes_id']]);
                }
                $this->emit('alert_store');
            }
            // ClientITSupportServicesRequestDatabase::create($this->data);
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->letters = [];
        $this->temp_letters = [];
        $this->emit('closeITSupportServicesRequestView');
        $this->emit('refresh_it_support_services_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }

    public function openITSupportServicesView($ITSupportServicesRequestID)
    {
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }
        $this->ITSupportServicesRequestID=$ITSupportServicesRequestID;
        $DATA=ClientITSupportServicesDatabase::find($this->ITSupportServicesRequestID);
        $DATA->with('getStatus');
        $this->request_no = 'IR'.(6600+$DATA['id']);
        $this->person_incharge = $DATA['person_incharge'];
        $this->event_information = $DATA['event_information'];
        $this->schedule = $DATA['schedule'];
        $this->status_id = $DATA->getStatus->status;
        $this->status_check = $DATA['status_id'];
        $this->letters = $DATA['letter'];
        $this->letters= json_decode($this->letters , true);
        $this->temp_letters=$this->letters;
        $this->edit_data=1;
        $this->cancel_reason=$DATA['cancel_reason'];
        $tools = ITSupportServiceEquipmentsUsedDatabase::all()->where('used_id', $this->ITSupportServicesRequestID);
        $this->count=0;
        foreach ($tools as $tool){
            $this->orderProducts[$this->count] = ['equipment_id'=>$tool->id,'used_id'=>$tool->used_id,'item_id' => $tool->item_id, 'itemdes_id' => $tool->itemdes_id];
            $this->count++;
        }
        

    }
    
    public function render()
    {
        return view('livewire.client-panel.request-tech-services.i-t-support-services-view',[
            'select_items' => EquipmentSeviceDatabase::all(),
            'select_des' => EquipmentDescriptionDatabase::withTrashed()->get(),
        ]);
    }
    
    public function closeITSupportServicesRequestView(){
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }
        $this->emit('closeITSupportServicesRequestView');
        $this->emit('refresh_it_support_services_table');
        $this->edit_data=0;
        $this->letters = [];
        $this->temp_letters = [];
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
