<?php

namespace App\Http\Livewire\PersonnelPanel\ManageRequest;

use App\Models\BorrowEquipmentsUsedDatabase;
use App\Models\ClientBorrowEquipmentRequestDatabase;
use App\Models\InventoryEquipmentDatabase;
use App\Models\User;
use App\Models\UserActivityLogsDatabase;
use App\Models\WorkTicketDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class PersonnelBorrowRequestView extends Component
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
            $personnel_id,
            $client_id,
            $WorkTicketID,
            $cancel_reason,
            $cancelButton=false;
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
    
    protected $listeners = [
    'viewBorrowEquipmentRequest',
    'selectedPersonnel',
    'cancel',
    'viewWorkTicketID',
    'showCancelButton',
    'cancelWorkTicketDataBR'
    ];
    
    public function selectedPersonnel($id){

        if($id){
            $this->personnel_id = $id;
        }else{
            $this->personnel_id = null;
        }
    }

    public function cancelBorrowRequest($BorrowEquipmentRequestID){
        $this->emit('openCancelConfirmModal');
        $this->emit('cancelDataID',$BorrowEquipmentRequestID);
    }

    public function cancelWorkTicketBR($BorrowEquipmentRequestID){
        $this->emit('openCancelConfirmModal');
        $this->emit('cancelWorkTicketBRID',$BorrowEquipmentRequestID);
        // ClientTechnicalRequestDatabase::destroy($this->BorrowEquipmentRequestID);
    }
    
    public function ongoing()
    {
        $this->data = ([
            'status_id'                 => 4,

        
        ]);
        

        try {
            if($this->BorrowEquipmentRequestID){
                $check_status=ClientBorrowEquipmentRequestDatabase::find($this->BorrowEquipmentRequestID);
                if($check_status['status_id']!=$this->status_check){
                    $this->emit('alert_warning');
                    $this->images = [];
                    $this->temp_images = [];
                    $this->letters = [];
                    $this->temp_letters = [];
                    $this->emit('closeBorrowEquipmentRequestView');
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
                    $this->emit('closeBorrowEquipmentRequestView');
                    $this->emit('refresh_work_ticket_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
                ClientBorrowEquipmentRequestDatabase::find($this->BorrowEquipmentRequestID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Request No. '.'BR'.(2200+$this->BorrowEquipmentRequestID).' is successfully Ongoing to Borrow Equipment Request',
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

        $this->images = [];
        $this->temp_images = [];
        $this->letters = [];
        $this->temp_letters = [];
        $this->emit('closeBorrowEquipmentRequestView');
        $this->emit('refresh_work_ticket_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }
    
    public function changepersonnel()
    {
        $this->emit('openChangePersonnelModal');
        $this->emit('borrowID',$this->BorrowEquipmentRequestID,$this->WorkTicketID);
    }
    
    public function completed()
    {
        $this->data = ([
            'status_id'                 => 5,

        
        ]);
        

        try {
            if($this->BorrowEquipmentRequestID){
                $check_status=ClientBorrowEquipmentRequestDatabase::find($this->BorrowEquipmentRequestID);
                foreach ($this->orderProducts as $key3) {
                $data4 = ([
                    'client_id'     =>$check_status->client_id,
                    'end_user'      =>$check_status->user_office_info,
                    'status_id'     =>8,
                ]);
                InventoryEquipmentDatabase::find($key3['device_id'])->update($data4);
                }
                if($check_status['status_id']!=$this->status_check){
                    $this->emit('alert_warning');
                    $this->images = [];
                    $this->temp_images = [];
                    $this->letters = [];
                    $this->temp_letters = [];
                    $this->emit('closeBorrowEquipmentRequestView');
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
                    $this->emit('closeBorrowEquipmentRequestView');
                    $this->emit('refresh_work_ticket_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
                    $this->edit_data=0;
        			return back();
                }
                ClientBorrowEquipmentRequestDatabase::find($this->BorrowEquipmentRequestID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Request No. '.'BR'.(2200+$this->BorrowEquipmentRequestID).' is successfully completed to Borrow Equipment Request',
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
        $this->emit('closeBorrowEquipmentRequestView');
        $this->emit('refresh_work_ticket_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }
    
    
    public function cancel($BorrowEquipmentRequestID,$cancel_reason){
        $status = ([
            'status_id'                 => 3,
            'cancel_reason'             => $cancel_reason,
        ]);
        ClientBorrowEquipmentRequestDatabase::find($BorrowEquipmentRequestID)->update($status);
        $this->emit('closeCancelConfirmModal');
        $this->emit('closeBorrowEquipmentRequestView');
        $this->emit('refresh_borrow_equipment_table');
        $this->emit('alert_update');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Request No. '.'BR'.(2200+$BorrowEquipmentRequestID).' is successfully Cancelled to Borrow Equipment Request',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
    
    public function cancelWorkTicketDataBR($BorrowEquipmentRequestID,$cancel_reason){      // for Work Ticket Table
        $check_status=ClientBorrowEquipmentRequestDatabase::find($this->BorrowEquipmentRequestID);
            if($check_status['status_id']!=$this->status_check){
                $this->emit('alert_warning');
                $this->images = [];
                $this->temp_images = [];
                $this->letters = [];
                $this->temp_letters = [];
                $this->emit('closeCancelConfirmModal');
                $this->emit('closeBorrowEquipmentRequestView');
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
        ClientBorrowEquipmentRequestDatabase::find($BorrowEquipmentRequestID)->update($status);
        $this->emit('closeCancelConfirmModal');
        $this->emit('closeBorrowEquipmentRequestView');
        $this->emit('refresh_work_ticket_table');
        $this->emit('alert_cancel');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Request No. '.'BR'.(2200+$BorrowEquipmentRequestID).' is successfully Cancelled to Borrow Equipment Request',
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
        $tools = BorrowEquipmentsUsedDatabase::all()->where('used_id', $this->BorrowEquipmentRequestID);
        $this->count=0;
        foreach ($tools as $tool){
            $this->orderProducts[$this->count] = ['equipment_id'=>$tool->id,'used_id'=>$tool->used_id,'device_id' => $tool->device_id];
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
        return view('livewire.personnel-panel.manage-request.personnel-borrow-request-view',[
            
            'select_items' => InventoryEquipmentDatabase::withTrashed()->get(),
            'assign_personnel'  =>  User::all()->where('rule_id',2),
        ])->with('getStatus');
    }
    
    public function hydrate(){
        $this->emit('select2');

    }
    
    
    public function closeBorrowEquipmentRequestView(){
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }
        $this->emit('closeBorrowEquipmentRequestView');
        $this->emit('refresh_borrow_equipment_table');
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
}
