<?php

namespace App\Http\Livewire\AdminPanel\ManageUsers;

use App\Models\User;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ClientForm extends Component
{
    use WithFileUploads;

    public  $data = [];
    public  $name,
            $email,
            $temp_email,
            $password,
            $newpassword,
            $confirmpassword,
            $rule_id;
    public  $UserID;
    public  $edit_data=0;
    
    protected $listeners = ['editClientData'];
    
    public function store()
    {
        if ($this->UserID) {
            if ($this->temp_email==$this->email) {
                $this->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'newpassword' => 'same:confirmpassword',
                    'confirmpassword' => '',
                ]);
            } else {
                $this->validate([
                    'name' => 'required',
                    'email' => 'required|unique:users,email',
                    'newpassword' => 'same:confirmpassword',
                    'confirmpassword' => '',
                ]);
            }
        } else {
        
            $this->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|same:confirmpassword',
                'confirmpassword' => 'required',
            ]);
        }
        
        $this->data = ([
            'name'                      => $this->name,
            'email'                     => $this->email
        ]);

        try {
            if($this->UserID){
                if ($this->newpassword) {
                    $this->data['password']=bcrypt($this->newpassword);
                }
                User::find($this->UserID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Client ID. '.(177001477+$this->UserID).' is successfully Updated to Client Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
                
            }else{
                
                $this->data['password']=bcrypt($this->password);
                $this->data['rule_id']=3;
                $show=User::create($this->data);
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Client ID. '.(177001477+$show['id']).' is successfully Store to Client Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);
                
            }
            
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->emit('closeClientModal');
        $this->emit('refresh_client_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->edit_data=0;
    }

    public function editClientData($UserID)
    {
        $this->UserID=$UserID;
        $DATA=User::find($this->UserID);
        $this->name = $DATA['name'];
        $this->email = $DATA['email'];
        $this->edit_data=1;

    }

    public function render()
    {
        return view('livewire.admin-panel.manage-users.client-form');
    }
    
    
    public function closeClientForm(){
        $this->emit('closeClientModal');
        $this->emit('refresh_client_table');
        $this->edit_data=0;
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
