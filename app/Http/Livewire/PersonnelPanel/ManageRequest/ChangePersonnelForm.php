<?php

namespace App\Http\Livewire\PersonnelPanel\ManageRequest;

use App\Models\ClientITSupportServicesDatabase;
use App\Models\ClientTechnicalRequestDatabase;
use App\Models\User;
use App\Models\UserActivityLogsDatabase;
use App\Models\WorkTicketDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChangePersonnelForm extends Component
{
    public $personnel_id;
    public  $technicalID,
            $supportID,
            $borrowID,
            $workticketID;
    protected $listeners = [
    'technicalID',
    'supportID',
    'borrowID'
    ];
    
    public function technicalID($technicalID,$workticketID)
    {
    $this->technicalID=$technicalID;
    $this->workticketID=$workticketID;
    }
    
    public function supportID($supportID,$workticketID)
    {
    $this->supportID=$supportID;
    $this->workticketID=$workticketID;
    }
    
    public function borrowID($borrowID,$workticketID)
    {
    $this->borrowID=$borrowID;
    $this->workticketID=$workticketID;
    }
    
    public function render()
    {
        return view('livewire.personnel-panel.manage-request.change-personnel-form',[
            'assign_personnel'  =>  User::all()->where('rule_id',2)->whereNotIn('id',Auth::user()->id),
            ]);
    }
    
    public function changepersonnelid()
    {
        $this->validate([
            'personnel_id' => 'required',
        ]);
        $data = ([
            'personnel_id'                 => $this->personnel_id,
        ]);
        if (!empty($this->technicalID)) {
            ClientTechnicalRequestDatabase::find($this->technicalID)->update($data);
            date_default_timezone_set('Etc/GMT-8');
            $log_data = ([
                'user_id'       =>  Auth::user()->id,
                'activity'      =>  'This Request No. '.'TR'.(1001339700+$this->technicalID).' is successfully Updated to Technical Request',
                'created_at'    =>  date('Y-m-d H:i:s')
                ]);
            UserActivityLogsDatabase::create($log_data);
        }
        if (!empty($this->supportID)) {
            ClientITSupportServicesDatabase::find($this->supportID)->update($data);
            date_default_timezone_set('Etc/GMT-8');
            $log_data = ([
                'user_id'       =>  Auth::user()->id,
                'activity'      =>  'This Request No. '.'IR'.(1003339700+$this->supportID).' is successfully Updated to IT Support Services Request',
                'created_at'    =>  date('Y-m-d H:i:s')
                ]);
            UserActivityLogsDatabase::create($log_data);
        }
        if (!empty($this->borrowID)) {
            ClientTechnicalRequestDatabase::find($this->borrowID)->update($data);
            date_default_timezone_set('Etc/GMT-8');
            $log_data = ([
                'user_id'       =>  Auth::user()->id,
                'activity'      =>  'This Request No. '.'BR'.(1006339700+$this->borrowID).' is successfully Updated to Borrow Equipment Request',
                'created_at'    =>  date('Y-m-d H:i:s')
                ]);
            UserActivityLogsDatabase::create($log_data);
        }
        
        $log_data2 = ([                         // for WorkTicket Table
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Work Ticket No. '.'TK'.(1231339100+$this->workticketID).' is successfully Updated to Work Ticket',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data2);
        
        WorkTicketDatabase::find($this->workticketID)->update($data);
        
        $this->emit('closeChangePersonnelModal');
        if (!empty($this->technicalID)) {
            $this->emit('closeTechnicalRequestView');
        }
        if (!empty($this->supportID)) {
            $this->emit('closeITSupportServicesRequestView');
        }
        if (!empty($this->borrowID)) {
            $this->emit('closeBorrowEquipmentRequestView');
        }
        $this->emit('refresh_work_ticket_table');
        $this->emit('alert_change');
    }
    
    public function closeChangePersonnelModal()
    {
        $this->emit('closeChangePersonnelModal');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
