<?php

namespace App\Http\Livewire\ClientPanel\RequestBorrow;

use App\Models\BorrowEquipmentsUsedDatabase;
use App\Models\ClientBorrowEquipmentRequestDatabase;
use App\Models\InventoryEquipmentDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class BorrowEquipmentForm extends Component
{
    use WithFileUploads;

    public  $images = [];
    public  $temp_images = [];
    public  $letters = [];
    public  $temp_letters = [];
    public  $data = [];
    public  $user_office_info,
            $purpose;
    public  $BorrowEquipmentRequestID;
    public  $edit_data=0;

    // sample
    public  $orderProducts = [];
    public  $device_id = [];
    public  $count = 0;
    public  $count2 = 0;
    public  $status_id;

    

    public function addProduct()
    
{
    $this->orderProducts[] = ['equipment_id'=>'','device_id'=>'','used_id' => ''];
    
}

public function removeProduct($index)
{   
    // dd($this->orderProducts[$index]['equipment_id']);
    unset($this->orderProducts[$index]);
    $this->orderProducts = array_values($this->orderProducts);
}

// end sample
    
    protected $listeners = [
    'editBorrowEquipmentRequest'
    ];
    
    public function store()
    {
        $this->validate([
            'images.*' => 'max:102400', // 1MB Max
            'letters.*' => 'max:102400', // 1MB Max
            'user_office_info' => 'required',
            'purpose' => '',
        ]);
        
        if($this->temp_images!=$this->images){
            foreach ($this->images as $key => $image) {
                $this->images[$key] = $image->store('images');
            }
        }
        if($this->temp_letters!=$this->letters){
            foreach ($this->letters as $key => $letter) {
                $this->letters[$key] = $letter->store('letters');
            }
        }
        
        $this->images = json_encode($this->images);
        $this->letters = json_encode($this->letters);
        
        $this->data = ([
            'image'                     => $this->images,
            'letter'                    => $this->letters,
            'user_office_info'          => $this->user_office_info,
            'purpose'                   => $this->purpose

        
        ]);
        

        try {
            if($this->BorrowEquipmentRequestID){
                $check_status=ClientBorrowEquipmentRequestDatabase::find($this->BorrowEquipmentRequestID);
                if($check_status['status_id']!=1){
                    $this->emit('alert_warning');
                    $this->images = [];
                    $this->temp_images = [];
                    $this->letters = [];
                    $this->temp_letters = [];
                    $this->emit('closeBorrowEquipmentRequestModal');
                    $this->emit('refresh_borrow_equipment_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
                ClientBorrowEquipmentRequestDatabase::find($this->BorrowEquipmentRequestID)->update($this->data); 
                $search_sample=BorrowEquipmentsUsedDatabase::where('used_id',$this->BorrowEquipmentRequestID)->get();
                $this->count=0;

                // for empty items
                if(count($this->orderProducts)==0){
                    foreach ($search_sample as $search_samp2){
                        BorrowEquipmentsUsedDatabase::destroy($search_samp2['id']);
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
                                BorrowEquipmentsUsedDatabase::destroy($search[$this->count]['id']);
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
                        BorrowEquipmentsUsedDatabase::create(['used_id' => $this->BorrowEquipmentRequestID,'device_id' => $key3['device_id']]);
                    }else{
                        BorrowEquipmentsUsedDatabase::find($this->orderProducts[$this->count]['equipment_id'])->update($this->orderProducts[$this->count]);
                        $this->count++;
                    }
                }
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Request No. '.'BR'.(2200+$this->BorrowEquipmentRequestID).' is successfully Updated to Borrow Equipment Request',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
            }else{
                $this->data['client_id']=Auth::user()->id;
                $this->data['status_id']=1;
                $show=ClientBorrowEquipmentRequestDatabase::create($this->data);
                foreach ($this->orderProducts as $key2) {
                    
                    BorrowEquipmentsUsedDatabase::create(['used_id' => $show['id'],'device_id' => $key2['device_id']]);
                }
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Request No. '.'BR'.(2200+$show['id']).' is successfully Store to Borrow Equipment Request',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);
            }
            // ClientBorrowEquipmentRequestDatabase::create($this->data);
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->images = [];
        $this->temp_images = [];
        $this->letters = [];
        $this->temp_letters = [];
        $this->emit('closeBorrowEquipmentRequestModal');
        $this->emit('refresh_borrow_equipment_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }

    public function editBorrowEquipmentRequest($BorrowEquipmentRequestID)
    {
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }

        $this->BorrowEquipmentRequestID=$BorrowEquipmentRequestID;
        $DATA=ClientBorrowEquipmentRequestDatabase::find($this->BorrowEquipmentRequestID);
        $this->user_office_info = $DATA['user_office_info'];
        $this->purpose = $DATA['purpose'];
        $this->status_id = $DATA['status_id'];
        $this->images = $DATA['image'];
        $this->images= json_decode($this->images , true);
        $this->temp_images=$this->images;
        $this->letters = $DATA['letter'];
        $this->letters= json_decode($this->letters , true);
        $this->temp_letters=$this->letters;
        $this->edit_data=1;
        $tools = BorrowEquipmentsUsedDatabase::all()->where('used_id', $this->BorrowEquipmentRequestID);
        $this->count=0;
        foreach ($tools as $tool){
            $this->orderProducts[$this->count] = ['equipment_id'=>$tool->id,'used_id'=>$tool->used_id,'device_id' => $tool->device_id];
            $this->count++;
        }
        // dd($this->orderProducts);
        
    }

    public function render()
    {
        return view('livewire.client-panel.request-borrow.borrow-equipment-form',[
            
            'select_items' => InventoryEquipmentDatabase::orderBy('device_name', 'ASC')->get(),
        ]);
    }
    
    
    public function closeBorrowEquipmentRequestForm(){
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }
        $this->emit('closeBorrowEquipmentRequestModal');
        $this->emit('refresh_borrow_equipment_table');
        $this->edit_data=0;
        $this->images = [];
        $this->temp_images = [];
        $this->letters = [];
        $this->temp_letters = [];
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
