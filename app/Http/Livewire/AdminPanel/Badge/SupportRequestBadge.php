<?php

namespace App\Http\Livewire\AdminPanel\Badge;

use App\Models\ClientITSupportServicesDatabase;
use Livewire\Component;

class SupportRequestBadge extends Component
{
    public $total=0;
    public function render()
    {
        return view('livewire.admin-panel.badge.support-request-badge',[
            'count_support_request' => ClientITSupportServicesDatabase::all()
            ]);
    }
}
