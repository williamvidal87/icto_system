<?php

namespace App\Http\Livewire\AdminPanel\ManageRequest;

use App\Models\ClientITSupportServicesDatabase;
use App\Models\EquipmentDescriptionDatabase;
use App\Models\EquipmentSeviceDatabase;
use App\Models\ITSupportServiceEquipmentsUsedDatabase;
use App\Models\User;
use App\Models\UserActivityLogsDatabase;
use App\Models\WorkTicketDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class SupportRequestView extends Component
{
    use WithFileUploads;
    
    public  $letters = [];
    public  $temp_letters = [];
    public  $data = [];
    public  $request_no,
            $person_incharge,
            $event_information,
            $schedule,
            $status_id,
            $status_check,
            $personnel_id,
            $client_id,
            $WorkTicketID,
            $cancel_reason,
            $cancelButton=false;
    public  $ITSupportServicesRequestID;
    public  $edit_data=0;

    // sample
        public  $orderProducts = [];
        public  $item_id = [];
        public  $itemdes_id = [];
        public  $count = 0;
        public  $count2 = 0;

        

        public function addProduct()
        
    {
        $this->orderProducts[] = ['equipment_id'=>'','item_id'=>'','used_id' => '', 'itemdes_id' => ''];
    }

    public function removeProduct($index)
    {   
        // dd($this->orderProducts[$index]['equipment_id']);
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }
    
    // end sample
    
    protected $listeners = [
    'openITSupportServicesView',
    'selectedPersonnel',
    'cancel',
    'viewWorkTicketID',
    'showCancelButton',
    'cancelWorkTicketDataIR'
    ];
    
    public function selectedPersonnel($id){

        if($id){
            $this->personnel_id = $id;
        }else{
            $this->personnel_id = null;
        }
    }

    public function cancelSupportRequest($ITSupportServicesRequestID){
        $this->emit('openCancelConfirmModal');
        $this->emit('cancelDataID',$ITSupportServicesRequestID);
        // ClientTechnicalRequestDatabase::destroy($this->ITSupportServicesRequestID);
    }

    public function cancelWorkTicketIR($ITSupportServicesRequestID){
        $this->emit('openCancelConfirmModal');
        $this->emit('cancelWorkTicketIRID',$ITSupportServicesRequestID);
        // ClientTechnicalRequestDatabase::destroy($this->ITSupportServicesRequestID);
    }

    public function approve()
    {
        $this->validate([
            'personnel_id' => 'required',
        ]);
        
        
        $this->data = ([
            'status_id'                 => 2,
            'personnel_id'              => $this->personnel_id,

        
        ]);

        try {
            if($this->ITSupportServicesRequestID){
                $check_status=ClientITSupportServicesDatabase::find($this->ITSupportServicesRequestID);
                if($check_status['status_id']!=1){
                    $this->emit('alert_warning');
                    $this->letters = [];
                    $this->temp_letters = [];
                    $this->emit('closeITSupportServicesRequestView');
                    $this->emit('refresh_it_support_services_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
                ClientITSupportServicesDatabase::find($this->ITSupportServicesRequestID)->update($this->data); 
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Request No. '.'IR'.(6600+$this->ITSupportServicesRequestID).' is successfully Approve to IT Support Services Request',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
                
                $this->data = ([
                    'support_id'                =>  $this->ITSupportServicesRequestID,
                    'request_no'                =>  'IR'.(6600+$this->ITSupportServicesRequestID),
                    'client_id'                 =>  $this->client_id,
                    'user_office_info'          =>  $this->person_incharge,
                    'status_id'                 =>  2,
                    'personnel_id'              =>  $this->personnel_id,
                    'request_category'          =>  2,//support type
                    'date_approve'              =>  date('Y-m-d H:i:s')
                ]);
                $show=WorkTicketDatabase::create($this->data);
                
                $log_data2 = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Work Ticket No. '.'TK'.(11000+$show['id']).' is successfully Store to Work Tickets',
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
        $this->emit('closeITSupportServicesRequestView');
        $this->emit('refresh_it_support_services_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }
    
    
    public function cancel($ITSupportServicesRequestID,$cancel_reason){
        $status = ([
            'status_id'                 => 3,
            'cancel_reason'             => $cancel_reason,
        ]);
        ClientITSupportServicesDatabase::find($ITSupportServicesRequestID)->update($status);
        $this->emit('closeCancelConfirmModal');
        $this->emit('closeITSupportServicesRequestView');
        $this->emit('refresh_it_support_services_table');
        $this->emit('alert_update');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Request No. '.'IR'.(6600+$ITSupportServicesRequestID).' is successfully Cancelled to IT Support Services Request',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
    
    public function cancelWorkTicketDataIR($ITSupportServicesRequestID,$cancel_reason){      // for Work Ticket Table
        $check_status=ClientITSupportServicesDatabase::find($this->ITSupportServicesRequestID);
            if($check_status['status_id']!=2){
                $this->emit('alert_warning');
                $this->letters = [];
                $this->temp_letters = [];
                $this->emit('closeCancelConfirmModal');
                $this->emit('closeITSupportServicesRequestView');
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
        ClientITSupportServicesDatabase::find($ITSupportServicesRequestID)->update($status);
        $this->emit('closeCancelConfirmModal');
        $this->emit('closeITSupportServicesRequestView');
        $this->emit('refresh_work_ticket_table');
        $this->emit('alert_cancel');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Request No. '.'IR'.(6600+$ITSupportServicesRequestID).' is successfully Cancelled to IT Support Services Request',
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

    public function openITSupportServicesView($ITSupportServicesRequestID)
    {
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }
        $this->ITSupportServicesRequestID=$ITSupportServicesRequestID;
        $DATA=ClientITSupportServicesDatabase::find($this->ITSupportServicesRequestID);
        $DATA->with('getStatus');
        $this->request_no = 'IR'.(6600+$DATA['id']);
        $this->person_incharge = $DATA['person_incharge'];
        $this->event_information = $DATA['event_information'];
        $this->schedule = $DATA['schedule'];
        $this->status_id = $DATA->getStatus->status;
        $this->status_check = $DATA['status_id'];
        $this->personnel_id = $DATA['personnel_id'];
        $this->client_id = $DATA['client_id'];
        $this->letters = $DATA['letter'];
        $this->letters= json_decode($this->letters , true);
        $this->temp_letters=$this->letters;
        $this->edit_data=1;
        $this->cancel_reason=$DATA['cancel_reason'];
        $tools = ITSupportServiceEquipmentsUsedDatabase::all()->where('used_id', $this->ITSupportServicesRequestID);
        $this->count=0;
        foreach ($tools as $tool){
            $this->orderProducts[$this->count] = ['equipment_id'=>$tool->id,'used_id'=>$tool->used_id,'item_id' => $tool->item_id, 'itemdes_id' => $tool->itemdes_id];
            $this->count++;
        }
        

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
        return view('livewire.admin-panel.manage-request.support-request-view',[
            'select_items' => EquipmentSeviceDatabase::withTrashed()->get(),
            'select_des' => EquipmentDescriptionDatabase::withTrashed()->get(),
            'assign_personnel'  =>  User::all()->where('rule_id',2),
        ]);
    }
    
    public function hydrate(){
        $this->emit('select2');

    }
    
    public function closeITSupportServicesRequestView(){
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }
        $this->emit('closeITSupportServicesRequestView');
        $this->emit('refresh_it_support_services_table');
        $this->emit('refresh_work_ticket_table');           //for WorkTokenTable
        $this->edit_data=0;
        $this->letters = [];
        $this->temp_letters = [];
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
