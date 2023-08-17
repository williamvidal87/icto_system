<?php

namespace App\Http\Livewire\DeleteData;

use Livewire\Component;

class Delete extends Component
{
    
    public $ID;

    protected $listeners = ['deleteAllAroundData'];

    public function deleteAllAroundData($ID)
    {
        $this->ID=$ID;
    }

    public function deleteData()
    {
        $this->emit('delete',$this->ID);
    }

    public function closeDeleteConfirmationModal(){
        
        $this->emit('closeDeleteConfirmModal');
        $this->emit('refresh_technical_table'); //for technical request table
        $this->emit('refresh_it_support_services_table'); //for support request table
        $this->emit('refresh_borrow_equipment_table'); //for borrow request table
        $this->emit('refresh_services_equipment_table'); //for services equipment table
        $this->emit('refresh_client_table'); //for client table
        $this->emit('refresh_admin_table'); //for admin table
        $this->emit('refresh_personnel_table'); //for personnel table
        $this->emit('refresh_service_type_table'); //for admin service type table
        $this->emit('refresh_inventory_equipment_table'); //for admin Inventory Equipment table
    }



    public function render()
    {
        return view('livewire.delete-data.delete');
    }
}
