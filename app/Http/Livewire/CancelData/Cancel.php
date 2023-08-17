<?php

namespace App\Http\Livewire\CancelData;

use Livewire\Component;

class Cancel extends Component
{
    
    public $ID,
    $WorkTicketTRID,
    $WorkTicketIRID,
    $WorkTicketBRID,
    $cancel_reason;

    protected $listeners = [
    'cancelDataID',
    'cancelWorkTicketTRID',
    'cancelWorkTicketIRID',
    'cancelWorkTicketBRID'
    ];

    public function cancelDataID($ID)
    {
        $this->ID=$ID;
    }
    
    public function cancelWorkTicketTRID($WorkTicketTRID)
    {
        $this->WorkTicketTRID=$WorkTicketTRID;
        $this->cancel_reason=null;
    }
    
    public function cancelWorkTicketIRID($WorkTicketIRID)
    {
        $this->WorkTicketIRID=$WorkTicketIRID;
        $this->cancel_reason=null;
    }
    
    public function cancelWorkTicketBRID($WorkTicketBRID)
    {
        $this->WorkTicketBRID=$WorkTicketBRID;
        $this->cancel_reason=null;
    }

    public function cancelData()
    {
        if($this->ID){
            $this->emit('cancel',$this->ID,$this->cancel_reason);
        }
        if($this->WorkTicketTRID){
            $this->emit('cancelWorkTicketDataTR',$this->WorkTicketTRID,$this->cancel_reason);
        }
        if($this->WorkTicketIRID){
            $this->emit('cancelWorkTicketDataIR',$this->WorkTicketIRID,$this->cancel_reason);
        }
        if($this->WorkTicketBRID){
            $this->emit('cancelWorkTicketDataBR',$this->WorkTicketBRID,$this->cancel_reason);
        }
    }

    public function closeCancelConfirmationModal(){
        $this->emit('closeCancelConfirmModal');
    }



    public function render()
    {
        return view('livewire.cancel-data.cancel');
    }
}
