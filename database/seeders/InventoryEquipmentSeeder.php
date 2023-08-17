<?php

namespace Database\Seeders;

use App\Models\InventoryEquipmentDatabase;
use Illuminate\Database\Seeder;

class InventoryEquipmentSeeder extends Seeder
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
                'created_at'                        => '2023-02-010 16:50:27',
                'specs'                             => 'Epson L6290',
                'serial_no' 			            => '15489',
                'property_no' 			            => 'l6290',
                'device_name' 			            => 'Printer',
                'status_id' 			            => '6',
                'image'                             => '[]'
            ],
            [
                'created_at'                        => '2023-02-11 16:50:27',
                'specs'                             => 'L1755UNL',
                'serial_no' 			            => 'EB-L1755UNL',
                'property_no' 			            => '3LCD',
                'device_name' 			            => 'Projector',
                'status_id' 			            => '6',
                'image'                             => '[]'
            ],
            [
                'created_at'                        => '2023-02-12 16:50:27',
                'specs'                             => 'TP-Link',
                'serial_no' 			            => 'AC1200',
                'property_no' 			            => 'MR600',
                'device_name' 			            => 'Router',
                'status_id' 			            => '6',
                'image'                             => '[]'
            ],
            [
                'created_at'                        => '2023-02-13 16:50:27',
                'specs'                             => 'I5 8GB 15.6" SILVER ACER LAPTOP',
                'serial_no' 			            => 'A315-58-55A6',
                'property_no' 			            => '55A6',
                'device_name' 			            => 'LAPTOP',
                'status_id' 			            => '6',
                'image'                             => '[]'
            ],
            [
                'created_at'                        => '2023-02-010 16:50:27',
                'specs'                             => 'Dell Computers 1366 x 768',
                'serial_no' 			            => 'E1916HV',
                'property_no' 			            => '361044475_PH-817450980',
                'device_name' 			            => 'Monitor',
                'status_id' 			            => '6',
                'image'                             => '[]'
            ],
            [
                'created_at'                        => '2023-02-11 16:50:27',
                'specs'                             => 'HDMI to VGA cable L=1.5M',
                'serial_no' 			            => 'none',
                'property_no' 			            => '1080',
                'device_name' 			            => 'HDMI cable',
                'status_id' 			            => '6',
                'image'                             => '[]'
            ],
            
        ];
        
        
        InventoryEquipmentDatabase::insert($equipment);
    }
}
