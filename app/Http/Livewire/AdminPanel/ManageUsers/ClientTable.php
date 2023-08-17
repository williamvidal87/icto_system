<?php

namespace App\Http\Livewire\AdminPanel\ManageUsers;

use App\Models\User;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClientTable extends Component
{
    protected $listeners = [
        'refresh_client_table' => '$refresh',
        'delete',
        'closedelete'
    
    ];
    
    public function render()
    {
        
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-users.client-table',[
            'Client_Data' => User::all()->where('rule_id',3)
            ]);
    }

    public function createClient(){
        $this->emit('openClientModal');
    }

    public function editClient($UserID){
        $this->emit('openClientModal');
        $this->emit('editClientData',$UserID);
    }

    public function deleteClient($UserID){
        $this->emit('openDeleteConfirmClientModal');
        $this->emit('deleteAllAroundData',$UserID);
    }

    public function delete($UserID){
        User::destroy($UserID);
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Client ID. '.(177001477+$UserID).' is successfully Deleted to Client Table',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
    public function closedelete(){
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
    }
}
