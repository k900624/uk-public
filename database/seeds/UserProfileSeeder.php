<?php

use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
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
                'user_id' => 1,
                'avatar' => 'avatars/thumbs/200/9e3607b72b33.jpg'
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'phone' => '+7 (123) 45-67-899',
                'phone2' => '+7 (123) 45-67-899',
                'avatar' => 'avatars/ssxtk4I7fOAWl2wW.jpg',
                'vkontakte' => 'vk.com/afonina80',
                'facebook' => 'fb.com/afonina80',
                'twitter' => 'twitter.com/afonina80',
                'odnoklassniki' => 'ok.com/afonina80',
                'telegram' => 'telegram.me/afonina80',
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'phone' => '+7 (123) 45-67-899',
                'phone2' => '+7 (123) 45-67-899',
            ],
            [
                'id' => 4,
                'user_id' => 4,
                'phone' => '+7 (123) 45-67-899',
                'phone2' => '+7 (123) 45-67-899',
            ],
        ];
        DB::table('user_profile')->insert($data);
    }
}
