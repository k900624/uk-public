<?php

use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
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
                'cat_id' => '1',
                'name' => 'user1',
                'email' => 'user1@mail.ru',
                'question' => 'Eligendi incidunt numquam repudiandae eaque?',
                'answer' => '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis repellat excepturi eius voluptate vel! Earum ea optio debitis iusto, odit id nam voluptate, dicta possimus obcaecati aliquam delectus recusandae enim.&lt;/p&gt;  &lt;p&gt;Eveniet labore illo, odio dolorem aliquam sapiente, nam corrupti in ea debitis id fugit deleniti non, praesentium maxime quod natus possimus odit aspernatur cupiditate itaque suscipit fugiat consectetur? Hic, aliquid?&lt;/p&gt;  &lt;p&gt;Nihil, provident expedita repudiandae exercitationem maxime rem commodi neque nisi architecto cumque nam enim! Officia ea nulla ex incidunt commodi, praesentium asperiores sequi nam! Ex ab magnam vero nulla iusto.&lt;/p&gt;',
                'ip_address' => '192.168.0.1',
                'published' => '1'
            ],
            [
                'id' => '2',
                'cat_id' => '1',
                'name' => 'user2',
                'email' => 'user2@mail.ru',
                'question' => 'Nihil provident expedita repudiandae exercitationem maxime rem commodi?',
                'answer' => '&lt;p&gt;Itaque, eligendi! Eligendi incidunt numquam repudiandae eaque? Labore a, nostrum cum ratione laudantium impedit obcaecati, quibusdam dicta iure tempora ad inventore tempore aliquid. Accusantium repellat repellendus iste totam odit vel.&lt;/p&gt;',
                'ip_address' => '192.168.0.1',
                'published' => '1'
            ],
            [
                'id' => '3',
                'cat_id' => '2',
                'name' => 'user3',
                'email' => 'user3@mail.ru',
                'question' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit?',
                'answer' => '&lt;p&gt;Nihil, provident expedita repudiandae exercitationem maxime rem commodi neque nisi architecto cumque nam enim! Officia ea nulla ex incidunt commodi, praesentium asperiores sequi nam! Ex ab magnam vero nulla iusto.&lt;/p&gt;  &lt;p&gt;Itaque, eligendi! Eligendi incidunt numquam repudiandae eaque? Labore a, nostrum cum ratione laudantium impedit obcaecati, quibusdam dicta iure tempora ad inventore tempore aliquid. Accusantium repellat repellendus iste totam odit vel.&lt;/p&gt;  &lt;p&gt;Quibusdam tempore voluptate ea modi, quidem quasi illo quisquam nostrum fugit, ipsa voluptatibus aspernatur provident harum quo corporis rem libero aliquid ratione sequi soluta atque doloremque? Eum accusamus voluptates consequuntur!&lt;/p&gt;',
                'ip_address' => '192.168.0.1',
                'published' => '1'
            ],
            [
                'id' => '4',
                'cat_id' => '0',
                'name' => 'user4',
                'email' => 'user4@mail.ru',
                'question' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit?',
                'answer' => 'null',
                'ip_address' => '192.168.0.1',
                'published' => '0'
            ]
        ];
        DB::table('faq')->insert($data);
    }
}
