<?php

namespace App\Http\Livewire\ClientPanel\Logs;

use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActivityLogs extends Component
{
    public function render()
    {
        return view('livewire.client-panel.logs.activity-logs',[
            'Activty_Logs'  =>  UserActivityLogsDatabase::where('user_id',Auth::user()->id)->get()
        ]);
    }
}
