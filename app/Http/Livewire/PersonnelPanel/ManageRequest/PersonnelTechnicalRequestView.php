<?php

namespace App\Http\Livewire\PersonnelPanel\ManageRequest;

use App\Models\ClientTechnicalRequestDatabase;
use App\Models\User;
use App\Models\UserActivityLogsDatabase;
use App\Models\WorkTicketDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class PersonnelTechnicalRequestView extends Component
{
    use WithFileUploads;
    
    public  $images = [];
    public  $temp_images = [];
    public  $letters = [];
    public  $temp_letters = [];
    public  $data = [];
    public  $work_ticket,
            $user_office_info,
            $problem,
            $status_id,
            $status_check,
            $personnel_id,
            $client_id,
            $WorkTicketID,
            $cancel_reason,
            $cancelButton=false;
    public  $TechnicalRequestID;
    public  $edit_data=0;
    
    
    protected $listeners = [
    'viewTechnicalRequest',
    'selectedPersonnel',
    'cancel',
    'viewWorkTicketID',
    'showCancelButton',
    'cancelWorkTicketDataTR'
    ];
    
    public function selectedPersonnel($id){

        if($id){
            $this->personnel_id = $id;
        }else{
            $this->personnel_id = null;
        }
    }

    public function cancelTechnicalRequest($TechnicalRequestID){
        $this->emit('openCancelConfirmModal');
        $this->emit('cancelDataID',$TechnicalRequestID);
        // ClientTechnicalRequestDatabase::destroy($this->TechnicalRequestID);
    }

    public function cancelWorkTicketTR($TechnicalRequestID){
        $this->emit('openCancelConfirmModal');
        $this->emit('cancelWorkTicketTRID',$TechnicalRequestID);
        // ClientTechnicalRequestDatabase::destroy($this->TechnicalRequestID);
    }

    public function viewTechnicalRequest($TechnicalRequestID)
    {
        $this->TechnicalRequestID=$TechnicalRequestID;
        $DATA=ClientTechnicalRequestDatabase::find($this->TechnicalRequestID);
        $DATA->with('getStatus');
        $this->work_ticket = 'TR'.(3300+$DATA['id']);
        $this->user_office_info = $DATA['user_office_info'];
        $this->problem = $DATA['problem'];
        $this->status_id = $DATA->getStatus->status;
        $this->status_check = $DATA['status_id'];
        $this->personnel_id = $DATA['personnel_id'];
        $this->client_id = $DATA['client_id'];
        $this->images = $DATA['image'];
        $this->images= json_decode($this->images , true);
        $this->temp_images=$this->images;
        $this->letters = $DATA['letter'];
        $this->letters= json_decode($this->letters , true);
        $this->temp_letters=$this->letters;
        $this->edit_data=1;
        $this->cancel_reason=$DATA['cancel_reason'];
        

    }
    
    public function viewWorkTicketID($WorkTicketID)
    {
        $this->WorkTicketID=$WorkTicketID;
    }
    
    public function showCancelButton($cancelButton)
    {
        $this->cancelButton=$cancelButton;
    }
    
    public function render()
    {
        return view('livewire.personnel-panel.manage-request.personnel-technical-request-view',[
            'assign_personnel'  =>  User::all()->where('rule_id',2),
            ]);
    }
    
    public function hydrate(){
        $this->emit('select2');

    }
    
    public function closeTechnicalRequestView(){
        $this->emit('closeTechnicalRequestView');
        $this->emit('refresh_work_ticket_table');
        $this->emit('refresh_work_ticket_table');           //for WorkTokenTable
        $this->edit_data=0;
        $this->images = [];
        $this->temp_images = [];
        $this->letters = [];
        $this->temp_letters = [];
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
    
    public function ongoing()
    {
        $this->data = ([
            'status_id'                 => 4,

        
        ]);

        try {
            if($this->TechnicalRequestID){
                $check_status=ClientTechnicalRequestDatabase::find($this->TechnicalRequestID);
                if($check_status['status_id']!=$this->status_check){
                    $this->emit('alert_warning');
                    $this->letters = [];
                    $this->temp_letters = [];
                    $this->emit('closeTechnicalRequestView');
                    $this->emit('refresh_work_ticket_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
                if($check_status['personnel_id']!=Auth::user()->id){
                    $this->emit('alert_warning');
                    $this->letters = [];
                    $this->temp_letters = [];
                    $this->emit('closeTechnicalRequestView');
                    $this->emit('refresh_work_ticket_table');
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
                    'activity'      =>  'This Request No. '.'TR'.(3300+$this->TechnicalRequestID).' is successfully Ongoing to Technical Request',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
                $show=WorkTicketDatabase::find($this->WorkTicketID)->update($this->data);
                
                $log_data2 = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Work Ticket No. '.'TK'.(11000+$this->WorkTicketID).' is successfully Ongoing to Work Tickets',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data2);
            }else{
            
            }
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->letters = [];
        $this->temp_letters = [];
        $this->emit('closeTechnicalRequestView');
        $this->emit('refresh_work_ticket_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }
    
    public function changepersonnel()
    {
        $this->emit('openChangePersonnelModal');
        $this->emit('technicalID',$this->TechnicalRequestID,$this->WorkTicketID);
    }
    
    public function completed()
    {
        $this->data = ([
            'status_id'                 => 5,
        ]);
        try {
            if($this->TechnicalRequestID){
                $check_status=ClientTechnicalRequestDatabase::find($this->TechnicalRequestID);
                if($check_status['status_id']!=$this->status_check){
                    $this->emit('alert_warning');
                    $this->images = [];
                    $this->temp_images = [];
                    $this->letters = [];
                    $this->temp_letters = [];
                    $this->emit('closeTechnicalRequestView');
                    $this->emit('refresh_work_ticket_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
                if($check_status['personnel_id']!=Auth::user()->id){
                    $this->emit('alert_warning');
                    $this->images = [];
                    $this->temp_images = [];
                    $this->letters = [];
                    $this->temp_letters = [];
                    $this->emit('closeTechnicalRequestView');
                    $this->emit('refresh_work_ticket_table');
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
                    'activity'      =>  'This Request No. '.'TR'.(3300+$this->TechnicalRequestID).' is successfully completed to Technical Request',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
                
                $show=WorkTicketDatabase::find($this->WorkTicketID)->update($this->data);
                
                $log_data2 = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Work Ticket No. '.'TK'.(11000+$this->WorkTicketID).' is successfully completed to Work Tickets',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data2);
            }else{
            
            }
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->images = [];
        $this->temp_images = [];
        $this->letters = [];
        $this->temp_letters = [];
        $this->emit('closeTechnicalRequestView');
        $this->emit('refresh_work_ticket_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }
    
    
    public function cancel($TechnicalRequestID,$cancel_reason){
        $status = ([
            'status_id'                 => 3,
            'cancel_reason'             => $cancel_reason,
        ]);
        ClientTechnicalRequestDatabase::find($TechnicalRequestID)->update($status);
        $this->emit('closeCancelConfirmModal');
        $this->emit('closeTechnicalRequestView');
        $this->emit('refresh_work_ticket_table');
        $this->emit('alert_cancel');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Request No. '.'TR'.(3300+$TechnicalRequestID).' is successfully Cancelled to Technical Request',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
    
    public function cancelWorkTicketDataTR($TechnicalRequestID,$cancel_reason){      // for Work Ticket Table
        $check_status=ClientTechnicalRequestDatabase::find($this->TechnicalRequestID);
                if($check_status['status_id']!=$this->status_check){
                    $this->emit('alert_warning');
                    $this->images = [];
                    $this->temp_images = [];
                    $this->letters = [];
                    $this->temp_letters = [];
                    $this->emit('closeCancelConfirmModal');
                    $this->emit('closeTechnicalRequestView');
                    $this->emit('refresh_work_ticket_table');
                    $this->reset(); 
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
    
                $status = ([
                    'status_id'                 => 3,
                    'cancel_reason'             => $cancel_reason,
                ]);
        ClientTechnicalRequestDatabase::find($TechnicalRequestID)->update($status);
        $this->emit('closeCancelConfirmModal');
        $this->emit('closeTechnicalRequestView');
        $this->emit('refresh_work_ticket_table');
        $this->emit('alert_cancel');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Request No. '.'TR'.(3300+$TechnicalRequestID).' is successfully Cancelled to Technical Request',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
        
        $log_data2 = ([                         // for WorkTicket Table
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Work Ticket No. '.'TK'.(11000+$this->WorkTicketID).' is successfully Cancelled to Work Ticket',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data2);
        
        WorkTicketDatabase::find($this->WorkTicketID)->update($status);
    }
}
