<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => '1', 'title' => 'Статьи', 'alias' => 'stati-1', 'parent_id' => '0', 'description' => 'Статьи сайта', 'published' => '1', 'ordering' => 0],
            ['id' => '2', 'title' => 'Новости', 'alias' => 'novosti-2', 'parent_id' => '0', 'description' => 'Новости сайта', 'published' => '0', 'ordering' => 0],
            ['id' => '3', 'title' => 'Спорт', 'alias' => 'sport', 'parent_id' => '1', 'description' => '', 'published' => '1', 'ordering' => 0],
            ['id' => '4', 'title' => 'Экономика', 'alias' => 'economic', 'parent_id' => '1', 'description' => '', 'published' => '1', 'ordering' => 1],
            ['id' => '5', 'title' => 'Политика', 'alias' => 'politic', 'parent_id' => '1', 'description' => '', 'published' => '1', 'ordering' => 1],
        ];

        DB::table('categories')->insert($data);
    }
}
