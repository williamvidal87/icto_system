<?php

namespace App\Http\Livewire\Chat;

use App\Models\ChatMessageDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBox extends Component
{

    public $tempmessage;
    public $temptime;
    public $message_count=0;
    public $listeners = [
    'refreshmessagecount' => '$refresh',
    'resetmessagecount' => 'resetcount'
    ];
    
    public function resetcount()
    {
        $this->message_count=0;
        $all_names = User::all();
        foreach ($all_names as $name) {
            $notseen=false;
            $messages_status=ChatMessageDatabase::where('to_id', Auth::user()->id)->get()->sortBy('created_at');
            foreach ($messages_status as $message_status) {
                if ($name->id==$message_status->from_id) {
                    if ($message_status->status_id==10||$message_status->status_id==null&&$name->id!=Auth::user()->id) {
                        $notseen=true;
                    }
                }
            }
            if ($notseen==true) {
                $this->message_count++;
            }
        }
    }
    public function mount()
    {
        $all_names = User::all();
        foreach ($all_names as $name) {
            $notseen=false;
            $messages_status=ChatMessageDatabase::where('to_id', Auth::user()->id)->get()->sortBy('created_at');
            foreach ($messages_status as $message_status) {
                if ($name->id==$message_status->from_id) {
                    if ($message_status->status_id==10||$message_status->status_id==null&&$name->id!=Auth::user()->id) {
                        $notseen=true;
                    }
                }
            }
            if ($notseen==true) {
                $this->message_count++;
            }
        }
    }
    
    public function render()
    {
    
        return view('livewire.chat.chat-box',[
            
            'all_names' => User::all(),
            'messages_status' => ChatMessageDatabase::where('to_id',Auth::user()->id)->get()->sortBy('created_at'),
            'last_message' => ChatMessageDatabase::all()->sortBy('created_at'),
        ]);

    }
        
    public function openChatForm($to_id){
        $this->emit('resetmessagecount');
        $this->emit('openchatboxmodal');
        $this->emit('SendMessageTo',$to_id);
        $change_status_not_seen=ChatMessageDatabase::where([['from_id',Auth::user()->id],['to_id',$to_id]])->orwhere([['from_id',$to_id],['to_id',Auth::user()->id]])->get()->sortBy('created_at');
        foreach ($change_status_not_seen as $change_seen_status) {
        if ($change_seen_status->to_id==Auth::user()->id) {
            $change_seen_status->status_id=9;
            $data=([
                'from_id'       =>  $change_seen_status->from_id,
                'to_id'         =>  $change_seen_status->to_id,
                'status_id'     =>  9,
            
            ]);
            ChatMessageDatabase::find($change_seen_status->id)->update($data);
        }
        }
    }
}
