<?php

use Illuminate\Database\Seeder;

class FaqCategoryTableSeeder extends Seeder
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
                'id' => '1',
                'title' => 'Категория 1',
            ],
            [
                'id' => '2',
                'title' => 'Категория 2',
            ]
        ];
        DB::table('faq_category')->insert($data);
    }
}
