<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
                'name' => 'admin',
                'display_name' => 'Администратор',
            ],
            [
                'name' => 'user',
                'display_name' => 'Пользователь',
            ],
            [
                'name' => 'manager_mc',
                'display_name' => 'Менеджер УК',
            ]
        ];
        DB::table('roles')->insert($data);
    }
}
