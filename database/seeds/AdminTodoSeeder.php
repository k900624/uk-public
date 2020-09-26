<?php

use Illuminate\Database\Seeder;

class AdminTodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ['id' => '1', 'title' => 'Новая задача', 'created_at' => '2018-12-11 11:13:35', 'status' => 1],
            ['id' => '2', 'title' => 'Еще одна задача', 'created_at' => '2018-12-12 04:47:28', 'status' => 0],
            ['id' => '3', 'title' => 'qwerty', 'created_at' => '2019-12-12 11:29:08', 'status' => 1],
        ];

        DB::table('admin_todo')->insert($data);
    }
}
