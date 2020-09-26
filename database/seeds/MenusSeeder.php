<?php

use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
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
                'parent_id' => 0,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Панель управления',
                'link' => '/',
                'ordering' => 1,
                'icon' => 'fa fa-home',
                'published' => '1'
            ],
            [
                'id' => 2,
                'parent_id' => 0,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Содержимое',
                'link' => '#',
                'ordering' => 2,
                'icon' => 'fa fa-files-o',
                'published' => '1'
            ],
            [
                'id' => 3,
                'parent_id' => 0,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Справочник',
                'link' => '/registry',
                'ordering' => 2,
                'icon' => 'fa fa-book',
                'published' => '1'
            ],
            [
                'id' => 4,
                'parent_id' => 0,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Компоненты',
                'link' => '#',
                'ordering' => 3,
                'icon' => 'fa fa-puzzle-piece',
                'published' => '1'
            ],
            [
                'id' => 5,
                'parent_id' => 0,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Пользователи',
                'link' => '#',
                'ordering' => 6,
                'icon' => 'fa fa-user',
                'published' => '1'
            ],
            [
                'id' => 6,
                'parent_id' => 0,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Отчеты',
                'link' => '#',
                'ordering' => 7,
                'icon' => 'fa fa-bar-chart-o',
                'published' => '1'
            ],
            [
                'id' => 10,
                'parent_id' => 4,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Категории',
                'link' => '/categories',
                'ordering' => 1,
                'icon' =>  '',
                'published' => '1'
            ],
            [
                'id' => 11,
                'parent_id' => 2,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Страницы',
                'link' => '/pages',
                'ordering' => 2,
                'icon' => '',
                'published' => '1'
            ],
            [
                'id' => 16,
                'parent_id' => 4,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Обратная связь',
                'link' => '/feedback',
                'ordering' => 4,
                'icon' => '',
                'published' => '1'
            ],
            [
                'id' => 18,
                'parent_id' => 5,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Группы',
                'link' => '/users/roles',
                'ordering' => 1,
                'icon' => '',
                'published' => '1'
            ],
            [
                'id' => 20,
                'parent_id' => 5,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Черный список',
                'link' => '/users/blacklist',
                'ordering' => 4,
                'icon' => '',
                'published' => '1'
            ],
            [
                'id' => 21,
                'parent_id' => 6,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Статистика',
                'link' => '/statistic',
                'ordering' => 1,
                'icon' =>  '',
                'published' => '1'
            ],
            [
                'id' => 22,
                'parent_id' => 2,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Меню',
                'link' => '/menu',
                'ordering' => 1,
                'icon' => '',
                'published' => '1'
            ],
            [
                'id' => 24,
                'parent_id' => 5,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Пользователи',
                'link' => '/users',
                'ordering' => 2,
                'icon' => '',
                'published' => '1'
            ],
            [
                'id' => 26,
                'parent_id' => 4,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Комментарии',
                'link' => '/comments',
                'ordering' => 3,
                'icon' => '',
                'published' => '1'
            ],
            [
                'id' => 28,
                'parent_id' => 4,
                'group_id' => 1,
                'title' => 'Новости',
                'type' => 'internal_link',
                'page_id' => 0,
                'link' => '/articles',
                'ordering' => 2,
                'icon' => '',
                'published' => '1'
            ],
            [
                'id' => 38,
                'parent_id' => 4,
                'group_id' => 1,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Faq',
                'link' => '/faq',
                'ordering' => 6,
                'icon' => '',
                'published' => '1'
            ],
            [
                'id' => 56,
                'parent_id' => 0,
                'group_id' => 2,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Главная',
                'link' => '/', 
                'icon' => '',
                'published' => '1',
                'ordering' => 0
            ],
            [
                'id' => 57,
                'parent_id' => 0,
                'group_id' => 2,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Контакты',
                'link' => '/page/contacts', 
                'icon' => '',
                'published' => '1',
                'ordering' => 1
            ],
            [
                'id' => 58,
                'parent_id' => 0,
                'group_id' => 2,
                'type' => 'page_link',
                'page_id' => 1,
                'title' => 'О нас',
                'link' => '/page/about', 
                'icon' => '',
                'published' => '1',
                'ordering' => 2
            ],
            [
                'id' => 62,
                'parent_id' => 0,
                'group_id' => 2,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Вопрос - ответ',
                'link' => '/faq', 
                'icon' => '',
                'published' => '1',
                'ordering' => 6
            ],
            [
                'id' => 63,
                'parent_id' => 0,
                'group_id' => 3,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Главная',
                'link' => '/', 
                'icon' => '',
                'published' => '1',
                'ordering' => 0
            ],
            [
                'id' => 64,
                'parent_id' => 0,
                'group_id' => 3,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Контакты',
                'link' => '/page/contacts', 
                'icon' => '',
                'published' => '1',
                'ordering' => 1
            ],
            [
                'id' => 65,
                'parent_id' => 0,
                'group_id' => 3,
                'type' => 'page_link',
                'page_id' => 1,
                'title' => 'О нас', 
                'link' => '/page/about', 
                'icon' => '',
                'published' => '1',
                'ordering' => 2
            ],
            [
                'id' => 66,
                'parent_id' => 0,
                'group_id' => 3,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Новости',
                'link' => '/articles', 
                'icon' => '',
                'published' => '1',
                'ordering' => 3
            ],
            [
                'id' => 72,
                'parent_id' => 0,
                'group_id' => 2,
                'type' => 'internal_link',
                'page_id' => 0,
                'title' => 'Новости',
                'link' => '/articles', 
                'icon' => '',
                'published' => '1',
                'ordering' => 3
            ],

        ];

        DB::table('menus')->insert($data);
    }
}
