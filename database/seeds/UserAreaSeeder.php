<?php

use Illuminate\Database\Seeder;

class UserAreaSeeder extends Seeder
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
                'user_id' => '2',
                'area_id' => '1',
                'main'    => 'on',
            ],
            [
                'user_id' => '3',
                'area_id' => '2',
                'main'    => 'on',
            ],
            [
                'user_id' => '4',
                'area_id' => '3',
                'main'    => 'on',
            ],
        ];
        DB::table('user_area')->insert($data);
    }
}
