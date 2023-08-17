<?php

namespace App\Http\Livewire\AdminPanel\ManageRequest;

use App\Models\ClientITSupportServicesDatabase;
use App\Models\EquipmentDescriptionDatabase;
use App\Models\ITSupportServiceEquipmentsUsedDatabase;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SupportRequest extends Component
{
    protected $listeners = [
        'refresh_it_support_services_table' => '$refresh',
    
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-request.support-request',[
            'Client_ITSupportServices_Request_Database' => ClientITSupportServicesDatabase::all(),
            'UsedEquipments' => ITSupportServiceEquipmentsUsedDatabase::all(),
            'equipmentdesc' => EquipmentDescriptionDatabase::withTrashed()->get()
            ])->with('getItemName','getStatus','getClientID');
    }

    public function editSupportRequest($ITSupportServicesRequestID){
        $this->emit('openITSupportServicesRequestModal');
        $this->emit('editITSupportServicesRequest',$ITSupportServicesRequestID);
    }

    public function openSupportView($ITSupportServicesRequestID){
        $this->emit('openITSupportServicesRequestView');
        $this->emit('openITSupportServicesView',$ITSupportServicesRequestID);
    }
    
    public function deleteITSupportServicesRequest($ITSupportServicesRequestID){
        $this->emit('openDeleteConfirmITSupportServicesRequestModal');
        $this->emit('deleteAllAroundData',$ITSupportServicesRequestID);
    }

    public function delete($ITSupportServicesRequestID){
        // dd($ITSupportServicesRequestID);
        ClientITSupportServicesDatabase::destroy($ITSupportServicesRequestID);
        $search_sample2=ITSupportServiceEquipmentsUsedDatabase::where('used_id',$ITSupportServicesRequestID)->get();
        foreach ($search_sample2 as $search_samp3){
            ITSupportServiceEquipmentsUsedDatabase::destroy($search_samp3['id']);
        }
        $this->emit('closeDeleteConfirmITSupportServicesRequestModal');
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Request No. '.'IR'.(6600+$ITSupportServicesRequestID).' is successfully Deleted to IT Support Services Request',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
    public function closedelete(){
        $this->emit('closeDeleteConfirmITSupportServicesRequestModal');
        $this->emit('EmitTable');
    }
}
