<?php

namespace App\Http\Livewire\ClientPanel\RequestTechServices;

use App\Models\ClientTechnicalRequestDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class TechnicalForm extends Component
{
    use WithFileUploads;

    public  $images = [];
    public  $temp_images = [];
    public  $letters = [];
    public  $temp_letters = [];
    public  $data = [];
    public  $user_office_info,
            $problem;
    public  $TechnicalRequestID;
    public  $edit_data=0;
    public  $status_id;
    
    protected $listeners = ['editTechnicalRequest'];
    
    public function store()
    {
        $this->validate([
            'images.*' => 'max:102400', // 1MB Max
            'letters.*' => 'max:102400', // 1MB Max
            'user_office_info' => 'required',
            'problem' => '',
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
            'problem'                   => $this->problem

        
        ]);
        // dd($this->TechnicalRequestID);

        try {
            if($this->TechnicalRequestID){
                $check_status=ClientTechnicalRequestDatabase::find($this->TechnicalRequestID);
                if($check_status['status_id']!=1){
                    $this->emit('alert_warning');
                    $this->images = [];
                    $this->temp_images = [];
                    $this->letters = [];
                    $this->temp_letters = [];
                    $this->emit('closeTechnicalRequestModal');
                    $this->emit('refresh_technical_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
                ClientTechnicalRequestDatabase::find($this->TechnicalRequestID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Request No. '.'TR'.(330+$this->TechnicalRequestID).' is successfully Updated to Technical Request',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
            }else{
                $this->data['client_id']=Auth::user()->id;
                $this->data['status_id']=1;
                $show=ClientTechnicalRequestDatabase::create($this->data);
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Request No. '.'TR'.(3300+$show['id']).' is successfully Store to Technical Request',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);
            }
            // ClientTechnicalRequestDatabase::create($this->data);
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->images = [];
        $this->temp_images = [];
        $this->letters = [];
        $this->temp_letters = [];
        $this->emit('closeTechnicalRequestModal');
        $this->emit('refresh_technical_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }

    public function editTechnicalRequest($TechnicalRequestID)
    {
        $this->TechnicalRequestID=$TechnicalRequestID;
        $DATA=ClientTechnicalRequestDatabase::find($this->TechnicalRequestID);
        $this->user_office_info = $DATA['user_office_info'];
        $this->problem = $DATA['problem'];
        $this->status_id = $DATA['status_id'];
        $this->images = $DATA['image'];
        $this->images= json_decode($this->images , true);
        $this->temp_images=$this->images;
        $this->letters = $DATA['letter'];
        $this->letters= json_decode($this->letters , true);
        $this->temp_letters=$this->letters;
        // dd($this->images);
        $this->edit_data=1;
        

    }

    public function render()
    {
        return view('livewire.client-panel.request-tech-services.technical-form');
    }
    
    
    public function closeTechnicalRequestForm(){
        $this->emit('closeTechnicalRequestModal');
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
