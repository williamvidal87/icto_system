<?php

namespace App\Http\Livewire\ClientPanel\RequestTechServices;

use App\Models\ClientTechnicalRequestDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Technical extends Component
{
    protected $listeners = [
        'refresh_technical_table' => '$refresh',
        'delete',
        'closedelete'
    
    ];
    
    public function render()
    {
        
        $this->emit('EmitTable');
        return view('livewire.client-panel.request-tech-services.technical',[
        'Client_Technical_Request_Database' => ClientTechnicalRequestDatabase::all()->where('client_id',Auth::user()->id)
        ])->with('getStatus');
    }

    public function createTechnicalRequest(){
        $this->emit('openTechnicalRequestModal');
    }

    public function editTechnicalRequest($TechnicalRequestID){
        $this->emit('openTechnicalRequestModal');
        $this->emit('editTechnicalRequest',$TechnicalRequestID);
    }
    
    public function openTechnicalView($TechnicalRequestID){
        $this->emit('openTechnicalRequestView');
        $this->emit('viewTechnicalRequest',$TechnicalRequestID);
    }

    public function deleteTechnicalRequest($TechnicalRequestID){
        $this->emit('openDeleteConfirmTechnicalRequestModal');
        $this->emit('deleteAllAroundData',$TechnicalRequestID);
        // ClientTechnicalRequestDatabase::destroy($this->TechnicalRequestID);
    }

    public function delete($TechnicalRequestID){
        ClientTechnicalRequestDatabase::destroy($TechnicalRequestID);
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Request No. '.'TR'.(3300+$TechnicalRequestID).' is successfully Deleted to Technical Request',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
    public function closedelete(){
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
    }
}
