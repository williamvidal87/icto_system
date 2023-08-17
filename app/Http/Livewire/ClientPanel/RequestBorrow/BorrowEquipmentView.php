<?php

namespace App\Http\Livewire\ClientPanel\RequestBorrow;

use App\Models\BorrowEquipmentsUsedDatabase;
use App\Models\ClientBorrowEquipmentRequestDatabase;
use App\Models\InventoryEquipmentDatabase;
use Livewire\Component;
use Livewire\WithFileUploads;

class BorrowEquipmentView extends Component
{
    use WithFileUploads;

    public  $images = [];
    public  $temp_images = [];
    public  $letters = [];
    public  $temp_letters = [];
    public  $data = [];
    public  $request_no,
            $user_office_info,
            $purpose,
            $status_id,
            $status_check,
            $cancel_reason;
    public  $BorrowEquipmentRequestID;
    public  $edit_data=0;

    // sample
    public  $orderProducts = [];
    public  $device_id = [];
    public  $count = 0;
    public  $count2 = 0;

    

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
    
    protected $listeners = ['viewBorrowEquipmentRequest'];
    

    public function viewBorrowEquipmentRequest($BorrowEquipmentRequestID)
    {
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }

        $this->BorrowEquipmentRequestID=$BorrowEquipmentRequestID;
        $DATA=ClientBorrowEquipmentRequestDatabase::find($this->BorrowEquipmentRequestID);
        $DATA->with('getStatus');
        $this->request_no = 'BR'.(2200+$DATA['id']);
        $this->user_office_info = $DATA['user_office_info'];
        $this->purpose = $DATA['purpose'];
        $this->status_id = $DATA->getStatus->status;
        $this->status_check = $DATA['status_id'];
        $this->images = $DATA['image'];
        $this->images= json_decode($this->images , true);
        $this->temp_images=$this->images;
        $this->letters = $DATA['letter'];
        $this->letters= json_decode($this->letters , true);
        $this->temp_letters=$this->letters;
        $this->edit_data=1;
        $this->cancel_reason=$DATA['cancel_reason'];
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
        return view('livewire.client-panel.request-borrow.borrow-equipment-view',[
            
            'select_items' => InventoryEquipmentDatabase::withTrashed()->get(),
        ]);
    }
    
    
    public function closeBorrowEquipmentRequestView(){
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }
        $this->emit('closeBorrowEquipmentRequestView');
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
