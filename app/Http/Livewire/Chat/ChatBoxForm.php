<?php

namespace App\Http\Livewire\Chat;

use App\Models\ChatMessageDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBoxForm extends Component
{
    public  $to_id,
            $deleteChatMessageID,
            $message;

    protected $listeners = [
    'SendMessageTo',
    'refreshMessage' => '$refresh'
    ];
    
    public function SendMessageTo($to_id)
    {
        $this->to_id=$to_id;
    }
    public function render()
    {
        
        $this->emit('refreshmessagecount');
        return view('livewire.chat.chat-box-form',[
        'all_messages' => ChatMessageDatabase::where([['from_id',Auth::user()->id],['to_id',$this->to_id]])->orwhere([['from_id',$this->to_id],['to_id',Auth::user()->id]])->get()->sortByDesc('created_at')
        ])->with('getfromName','gettoName');
    }
    
    public function store_message()
    {
        $check_space=$this->message;
        $remove_space =trim($check_space);
        if($remove_space==null)
        {
            return;
        }
        date_default_timezone_set('Etc/GMT-8');
        $data = ([
            'from_id'                       => Auth::user()->id,
            'to_id'                         => $this->to_id,
            'message'                       => $this->message,
            'status_id'                     => 10,
            'created_at'                    => date('Y-m-d H:i:s'),
        ]);

        
        ChatMessageDatabase::create($data);
                    
        $this->emit('refreshMessage');
        $this->message="";
    }
    
    public function closeChatForm()
    {
        $this->emit('refreshMessage');
        $this->emit('resetmessagecount');
        $this->emit('closechatboxmodal');
    }
    
    public function deleteChatMessage($deleteChatMessageID){
        ChatMessageDatabase::destroy($deleteChatMessageID);
        $this->emit('refreshMessage');
    }
}
