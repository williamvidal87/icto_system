<?php

namespace App\Http\Livewire\AdminPanel\Badge;

use App\Models\ClientTechnicalRequestDatabase;
use Livewire\Component;

class TechnicalRequestBadge extends Component
{
    public $total=0;
    public function render()
    {
        return view('livewire.admin-panel.badge.technical-request-badge',[
            'count_technical_request' => ClientTechnicalRequestDatabase::all()
            ]);
    }
}
