<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RulesPermissionSeeder::class,
            UserSeeder::class,
            StatusSeeder::class,
            EquipmentSeeder::class,
            EquipmentDescriptionSeeder::class,
            InventoryEquipmentSeeder::class,
            ChatMessageSeeder::class,
            RequestCategorySeeder::class
        ]);
    }
}
