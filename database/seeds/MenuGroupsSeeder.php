<?php

use Illuminate\Database\Seeder;

class MenuGroupsSeeder extends Seeder
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
                'id' => 1,
                'name' => 'admin',
                'title' => 'Админ меню',
            ],
            [
                'id' => 2,
                'name' => 'main',
                'title' => 'Главное меню',
            ],
            [
                'id' => 3,
                'name' => 'footer',
                'title' => 'Нижнее меню',
            ],
            [
                'id' => 4,
                'name' => 'sidebar',
                'title' => 'Боковое меню',
            ],
        ];

        DB::table('menu_groups')->insert($data);
    }
}
