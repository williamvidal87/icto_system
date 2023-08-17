<?php

namespace App\Http\Livewire\AdminPanel\Badge;

use App\Models\WorkTicketDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WorkTicketApproveBadge extends Component
{
    public $total=0;
    public function render()
    {
        return view('livewire.admin-panel.badge.work-ticket-approve-badge',[
            'count_work_ticket_approve' => WorkTicketDatabase::where('personnel_id',Auth::user()->id)->get()
            ]);
    }
}
