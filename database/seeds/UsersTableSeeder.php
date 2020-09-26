<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'email' => 'admin@admin.ru',
                'password' => bcrypt('8239r0m4'),
                'api_token' => \Str::random(80),
                'created_at' => '2020-06-29 07:01:50',
                'updated_at' => '2020-06-29 07:01:50',
            ],
            [
                'id' => 2,
                'name' => 'Афонина Алина Викторовна',
                'email' => 's-fr@yandex.ru',
                'password' => bcrypt('password'),
                'api_token' => \Str::random(80),
                'created_at' => '2020-06-29 07:01:50',
                'updated_at' => '2020-06-29 07:01:50',
                'invited_at' => '2020-06-29 07:01:50',
            ],
            [
                'id' => 3,
                'name' => 'Иванова Ирина Федоровна',
                'email' => 'ivanova@gmail.com',
                'api_token' => \Str::random(80),
                'created_at' => '2020-06-29 07:01:50',
                'updated_at' => '2020-06-29 07:01:50',
            ],
            [
                'id' => 4,
                'name' => 'Шилова Лидия Ивановна',
                'email' => 'shilova@mail.ru',
                'api_token' => \Str::random(80),
                'created_at' => '2020-06-29 07:01:50',
                'updated_at' => '2020-06-29 07:01:50',
            ],
        ];
        DB::table('users')->insert($data);
    }

}
