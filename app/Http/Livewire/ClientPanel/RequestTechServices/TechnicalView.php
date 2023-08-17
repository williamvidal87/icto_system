<?php

namespace App\Http\Livewire\ClientPanel\RequestTechServices;

use App\Models\ClientTechnicalRequestDatabase;
use Livewire\Component;
use Livewire\WithFileUploads;

class TechnicalView extends Component
{
use WithFileUploads;
 
    public  $images = [];
    public  $temp_images = [];
    public  $letters = [];
    public  $temp_letters = [];
    public  $data = [];
    public  $request_no,
            $user_office_info,
            $problem,
            $status_id,
            $status_check,
            $cancel_reason;
    public  $TechnicalRequestID;
    public  $edit_data=0;
    
    
    protected $listeners = ['viewTechnicalRequest'];

    public function viewTechnicalRequest($TechnicalRequestID)
    {
        $this->TechnicalRequestID=$TechnicalRequestID;
        $DATA=ClientTechnicalRequestDatabase::find($this->TechnicalRequestID);
        $DATA->with('getStatus');
        $this->request_no = 'TR'.(3300+$DATA['id']);
        $this->user_office_info = $DATA['user_office_info'];
        $this->problem = $DATA['problem'];
        $this->status_id = $DATA->getStatus->status;
        $this->status_check = $DATA['status_id'];
        $this->images = $DATA['image'];
        $this->images= json_decode($this->images , true);
        $this->temp_images=$this->images;
        $this->letters = $DATA['letter'];
        $this->letters= json_decode($this->letters , true);
        $this->temp_letters=$this->letters;
        // dd($this->images);
        $this->edit_data=1;
        $this->cancel_reason=$DATA['cancel_reason'];
        

    }
    public function render()
    {
        return view('livewire.client-panel.request-tech-services.technical-view');
    }
    
    public function closeTechnicalRequestView(){
        $this->emit('closeTechnicalRequestView');
        $this->emit('refresh_technical_table');
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
