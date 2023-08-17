<?php

namespace Database\Seeders;

use App\Models\EquipmentSeviceDatabase;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipment = [
        [
            'equipment_name' 			=> 'Networking',
            'status_id' 			    => '6',
        ],
        
    ];
    
    
    EquipmentSeviceDatabase::insert($equipment);
    }
}
