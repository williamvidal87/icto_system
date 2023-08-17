<?php

namespace App\Http\Livewire\AdminPanel\Badge;

use App\Models\ClientBorrowEquipmentRequestDatabase;
use Livewire\Component;

class BorrowRequestBadge extends Component
{
    public $total=0;
    public function render()
    {
        return view('livewire.admin-panel.badge.borrow-request-badge',[
            'count_borrow_request' => ClientBorrowEquipmentRequestDatabase::all()
            ]);
    }
}
