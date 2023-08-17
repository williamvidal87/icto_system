<?php

namespace App\Http\Livewire\AdminPanel\ManageRecords;

use App\Models\WorkTicketDatabase;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class AccomplishmentsReport extends Component
{

    protected $listeners = [
        'refresh_table' => '$refresh'];
        
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-records.accomplishments-report',[
            'WorkTicketDatabase' => WorkTicketDatabase::all()
            ])->with('getStatus','getClient','getPersonnel');
    }
    
    public function PrintAccomplishmentToPDF()
    {   
        $this->emit('EmitTable');
        $this->emit('refresh_table');
        $pdfContent = PDF::loadView('livewire.admin-panel.print-reports.accomplishment-print',[
            'WorkTicketDatabasePrint' => WorkTicketDatabase::orderBy('created_at', 'ASC')->get()
            ])->setPaper('Legal', 'Portrait')->output();
        return response()->streamDownload(fn () => print($pdfContent),"accomplishment.pdf");
    }
}
