<?php

namespace App\Http\Livewire\AdminPanel\Badge;

use App\Models\ClientBorrowEquipmentRequestDatabase;
use App\Models\ClientITSupportServicesDatabase;
use App\Models\ClientTechnicalRequestDatabase;
use Livewire\Component;

class ManageRequestBadge extends Component
{
    public $total=0;
    public function render()
    {
        return view('livewire.admin-panel.badge.manage-request-badge',[
            'count_technical_request' => ClientTechnicalRequestDatabase::all(),
            'count_support_request' => ClientITSupportServicesDatabase::all(),
            'count_borrow_request' => ClientBorrowEquipmentRequestDatabase::all()
            ]);
    }
}
