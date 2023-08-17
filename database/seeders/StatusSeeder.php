<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
			[

				'status' 			=> 'Pending',
			],
			[
				'status' 			=> 'Approved',
			],
            [
				'status' 			=> 'Cancelled',
			],
            [
				'status' 			=> 'Ongoing',
			],
            [
				'status' 			=> 'Completed',
			],
            [
				'status' 			=> 'Available',
			],
            [
				'status' 			=> 'Defective',
			],
            [
				'status' 			=> 'Unreturned',
			],
            [
				'status' 			=> 'Seen',
			],
            [
				'status' 			=> 'NotSeen',
			],
            [
				'status' 			=> 'Not Available',
			],
            
        ];
        
        
        Status::insert($statuses);
    }
}
