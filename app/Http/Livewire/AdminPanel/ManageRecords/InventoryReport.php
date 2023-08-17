<?php

namespace App\Http\Livewire\AdminPanel\ManageRecords;

use App\Models\InventoryEquipmentDatabase;
use Livewire\Component;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
class InventoryReport extends Component
{
    
    protected $listeners = [
        'refresh_table' => '$refresh'];
        
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-records.inventory-report',[
            'Inventory_Equipment_Data' => InventoryEquipmentDatabase::all()
            ])->with('getStatus','getClient');
    }
    
    public function PrintInventoryToPDF()
    {   
        $this->emit('EmitTable');
        $this->emit('refresh_table');
        $pdfContent = PDF::loadView('livewire.admin-panel.print-reports.inventory-print',[
            'Inventory_Equipment_Print' => InventoryEquipmentDatabase::orderBy('device_name', 'ASC')->get()
            ])->setPaper('Legal', 'Portrait')->output();
        return response()->streamDownload(fn () => print($pdfContent),"inventory.pdf");
    }
}
