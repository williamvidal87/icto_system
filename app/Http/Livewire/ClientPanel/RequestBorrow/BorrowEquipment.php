<?php

namespace App\Http\Livewire\ClientPanel\RequestBorrow;

use App\Models\BorrowEquipmentsUsedDatabase;
use App\Models\ClientBorrowEquipmentRequestDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BorrowEquipment extends Component
{
    protected $listeners = [
        'refresh_borrow_equipment_table' => '$refresh',
        'delete',
        'closedelete'
    ];
    
    public function render()
    {
        
        $this->emit('EmitTable');
        return view('livewire.client-panel.request-borrow.borrow-equipment',[
            'Client_Borrow_Equipment_Request_Database' => ClientBorrowEquipmentRequestDatabase::all()->where('client_id',Auth::user()->id),
            'UsedEquipments' => BorrowEquipmentsUsedDatabase::all(),
            ])->with('getStatus','getItemName');
    }
    
    public function createBorrowEquipmentRequest(){
        $this->emit('openBorrowEquipmentRequestModal');
    }
    
    public function editBorrowEquipmentRequest($BorrowEquipmentRequestID){
        $this->emit('openBorrowEquipmentRequestModal');
        $this->emit('editBorrowEquipmentRequest',$BorrowEquipmentRequestID);
    }
    
    public function openBorrowEquipmentRequestView($BorrowEquipmentRequestID){
        $this->emit('openBorrowEquipmentRequestView');
        $this->emit('viewBorrowEquipmentRequest',$BorrowEquipmentRequestID);
    }
    
    public function deleteBorrowEquipmentRequest($BorrowEquipmentRequestID){
        $this->emit('openDeleteConfirmBorrowEquipmentRequestModal');
        $this->emit('deleteAllAroundData',$BorrowEquipmentRequestID);
        // ClientBorrowEquipmentRequestDatabase::destroy($this->BorrowEquipmentRequestID);
    }
    
    public function delete($BorrowEquipmentRequestID){
        ClientBorrowEquipmentRequestDatabase::destroy($BorrowEquipmentRequestID);
        $search_sample2=BorrowEquipmentsUsedDatabase::where('used_id',$BorrowEquipmentRequestID)->get();
        foreach ($search_sample2 as $search_samp3){
            BorrowEquipmentsUsedDatabase::destroy($search_samp3['id']);
        }
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Request No. '.'BR'.(2200+$BorrowEquipmentRequestID).' is successfully Deleted to Borrow Equipment Request',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
    public function closedelete(){
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
    }
}
