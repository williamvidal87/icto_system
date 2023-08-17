<?php

namespace Database\Seeders;

use App\Models\RequestCategory;
use Illuminate\Database\Seeder;

class RequestCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 
            'request_type' => 'Technical Request',
            ],
            [ 
            'request_type' => 'Support Request'
            ],
            [ 
            'request_type' => 'Borrow Request',
            ],
        ];

        RequestCategory::insert($data);
    }
}
