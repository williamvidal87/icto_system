<?php

namespace Database\Seeders;

use App\Models\EquipmentDescriptionDatabase;
use Illuminate\Database\Seeder;

class EquipmentDescriptionSeeder extends Seeder
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
                'equipment_type_id' 			    => '1',
                'description' 			            => 'Install Internet',
                'status_id' 			            => '6',
            ],
            
        ];
        
        
        EquipmentDescriptionDatabase::insert($equipment);
    }
}
