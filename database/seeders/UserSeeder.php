<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [ 
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'rule_id' => 1,
            ],
            [ 
            'name' => 'Mary Joy Estoconing',
            'email' => 'maryjoy@gmail.com',
            'password' => bcrypt('client123'),
            'rule_id' => 3,
            ],
            [ 
            'name' => 'Wendelyn Bolobiogo Sarona',
            'email' => 'wendelyn@gmail.com',
            'password' => bcrypt('client123'),
            'rule_id' => 3,
            ],
            [ 
            'name' => 'Julie Ann Anonsawon',
            'email' => 'julie@gmail.com',
            'password' => bcrypt('client123'),
            'rule_id' => 3,
            ],
            [ 
            'name' => 'Ronnel Callao Araco',
            'email' => 'ronnel@gmail.com',
            'password' => bcrypt('client123'),
            'rule_id' => 3,
            ],
            [ 
            'name' => 'William Fernandez Vidal',
            'email' => 'william@gmail.com',
            'password' => bcrypt('client123'),
            'rule_id' => 3,
            ],
            [ 
            'name' => 'Personnel',
            'email' => 'personnel@gmail.com',
            'password' => bcrypt('personnel123'),
            'rule_id' => 2,
            ],
        ];

        User::insert($user);
    }
}
