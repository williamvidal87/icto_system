<?php

namespace App\Http\Livewire\AdminPanel\ManageRequest;

use App\Models\ClientTechnicalRequestDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TechinicalRequest extends Component
{
    protected $listeners = [
        'refresh_technical_table' => '$refresh'
    
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-request.techinical-request',[
            'Client_Technical_Request_Database' => ClientTechnicalRequestDatabase::all()
            ])->with('getStatus','getClientID');
    }

    public function editTechnicalRequest($TechnicalRequestID){
        $this->emit('openTechnicalRequestModal');
        $this->emit('editTechnicalRequest',$TechnicalRequestID);
    }
    
    public function openTechnicalView($TechnicalRequestID){
        $this->emit('openTechnicalRequestView');
        $this->emit('viewTechnicalRequest',$TechnicalRequestID);
    }
    public function closedelete(){
        $this->emit('closeDeleteConfirmTechnicalRequestModal');
        $this->emit('EmitTable');
    }
}
