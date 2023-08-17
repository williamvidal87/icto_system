<?php

namespace App\Http\Livewire\AdminPanel;

use App\Models\WorkTicketDatabase;
use Livewire\Component;

class WorkTicket extends Component
{
    protected $listeners = [
        'refresh_work_ticket_table' => '$refresh'
    ];
    
    public function render()
    {
        
        $this->emit('EmitTable');
        return view('livewire.admin-panel.work-ticket',[
            'WorkTicketDatabase' => WorkTicketDatabase::all(),
            ])->with(
            'getStatus',
            'getRequestCategory',
            'getClient',
            'getPersonnel',
            'getTechnicalID',
            'getSupportID',
            'getBorrowID',
            'getTechnicalPersonnelID',
            'getSupportPersonnelID',
            'getBorrowPersonnelID',
            'getTechnicalClientID',
            'getSupportClientID',
            'getBorrowClientID'
            );
    }
    
    public function openWorkTicketView($WorkTicketID,$CategoryID,$RequestID){
        
        if ($CategoryID==1) {                                       //TechnicalView
            $this->emit('openTechnicalRequestView');
            $this->emit('viewTechnicalRequest',$RequestID);
            $this->emit('viewWorkTicketID',$WorkTicketID);
            $cancelButton=true;
            $this->emit('showCancelButton',$cancelButton);
        }
        if ($CategoryID==2) {                                       //SupportView
            $this->emit('openITSupportServicesRequestView');
            $this->emit('openITSupportServicesView',$RequestID);
            $this->emit('viewWorkTicketID',$WorkTicketID);
            $cancelButton=true;
            $this->emit('showCancelButton',$cancelButton);
        }
        if ($CategoryID==3){                                        //BorrowView
            $this->emit('openBorrowEquipmentRequestView');
            $this->emit('viewBorrowEquipmentRequest',$RequestID);
            $this->emit('viewWorkTicketID',$WorkTicketID);
            $cancelButton=true;
            $this->emit('showCancelButton',$cancelButton);
        }
    }
}
