<?php

namespace App\Http\Livewire\AdminPanel\ManageUsers;

use App\Models\User;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PersonnelTable extends Component
{
    protected $listeners = [
        'refresh_personnel_table' => '$refresh',
        'delete',
        'closedelete'
    
    ];
    
    public function render()
    {
        
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-users.personnel-table',[
            'Personnel_Data' => User::all()->where('rule_id',2)
            ]);
    }

    public function createPersonnel(){
        $this->emit('openPersonnelModal');
    }

    public function editPersonnel($UserID){
        $this->emit('openPersonnelModal');
        $this->emit('editPersonnelData',$UserID);
    }

    public function deletePersonnel($UserID){
        $this->emit('openDeleteConfirmPersonnelModal');
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
            'activity'      =>  'This Personnel ID. '.(177001477+$UserID).' is successfully Deleted to Personnel Table',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
    public function closedelete(){
        $this->emit('closeDeleteConfirmModal');
        $this->emit('EmitTable');
    }
}
