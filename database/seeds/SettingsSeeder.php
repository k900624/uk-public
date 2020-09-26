<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
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
                'key' => 'enable_comments',
                'description' => 'Отображать комментарии',
                'value' => '1',
                'help' => '',
                'ordering' => 0,
                'type' => 'comments',
                'group' => null,
                'field' => 'checkbox'
            ],
            [
                'id' => 2,
                'key' => 'list_contents_count',
                'description' => 'Число записей на странице',
                'value' => '20',
                'help' => null,
                'ordering' => 1,
                'type' => 'articles',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 3,
                'key' => 'meta_keywords',
                'description' => 'Ключевые слова, для SEO',
                'value' => 'web, site, html5, responsive, layout, sxcore, laravel, starter, project',
                'help' => null,
                'ordering' => 4,
                'type' => 'seo',
                'group' => null,
                'field' => 'textarea'
            ],
            [
                'id' => 4,
                'key' => 'site_title',
                'description' => 'Заголовок сайта',
                'value' => 'Laravel starter project',
                'help' => null,
                'ordering' => 3,
                'type' => 'general',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 5,
                'key' => 'meta_description',
                'description' => 'Краткое описание, для SEO',
                'value' => 'Laravel starter project',
                'help' => null,
                'ordering' => 5,
                'type' => 'seo',
                'group' => null,
                'field' => 'textarea'
            ],
            [
                'id' => 6,
                'key' => 'phone',
                'description' => 'Телефон',
                'value' => '+7 (654) 65-46-546',
                'help' => null,
                'ordering' => 1,
                'type' => 'contacts',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 8,
                'key' => 'email',
                'description' => 'Email администратора сайта',
                'value' => 'admin@gmail.com',
                'help' => null,
                'ordering' => 4,
                'type' => 'contacts',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 10,
                'key' => 'facebook',
                'description' => 'Facebook',
                'value' => '',
                'help' => null,
                'ordering' => 14,
                'type' => 'contacts',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 11,
                'key' => 'vkontakte',
                'description' => 'ВКонтакте',
                'value' => 'http://vk.com/baluev_rv',
                'help' => null,
                'ordering' => 10,
                'type' => 'contacts',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 12,
                'key' => 'twitter',
                'description' => 'Twitter',
                'value' => '',
                'help' => null,
                'ordering' => 11,
                'type' => 'contacts',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 13,
                'key' => 'skype',
                'description' => 'Skype',
                'value' => '',
                'help' => null,
                'ordering' => 13,
                'type' => 'contacts',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 14,
                'key' => 'address',
                'description' => 'Адрес',
                'value' => 'Российская Федерация, Пермский край, г. Пермь, 614022',
                'help' => null,
                'ordering' => 0,
                'type' => 'contacts',
                'group' => null,
                'field' => 'textarea'
            ],
            [
                'id' => 15,
                'key' => 'instagram',
                'description' => 'Instagram',
                'value' => '',
                'help' => null,
                'ordering' => 12,
                'type' => 'contacts',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 16,
                'key' => 'site_name',
                'description' => 'Название сайта',
                'value' => 'SX-Core',
                'help' => null,
                'ordering' => 2,
                'type' => 'general',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 17,
                'key' => 'google_analytics_id',
                'description' => 'ID Google.Analytics',
                'value' => '',
                'help' => '<a href="https://analytics.google.com/analytics/web" target="_blank">Настроить</a>',
                'ordering' => 0,
                'type' => 'seo',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 18,
                'key' => 'yandex_metric_id',
                'description' => 'ID Yandex.Metrika',
                'value' => '',
                'help' => '<a href="https://metrika.yandex.ru/list" target="_blank">Настроить</a>',
                'ordering' => 1,
                'type' => 'seo',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 19,
                'key' => 'google_site_verification',
                'description' => 'G.Вэбмастер, ключ для верификации сайта',
                'value' => '',
                'help' => '<a href="https://www.google.ru/intl/ru/webmasters" target="_blank">Настроить</a>',
                'ordering' => 2,
                'type' => 'seo',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 20,
                'key' => 'yandex_verification',
                'description' => 'Я.Вэбмастер, ключ для верификации сайта',
                'value' => '',
                'help' => '<a href="https://webmaster.yandex.ru" target="_blank">Настроить</a>',
                'ordering' => 3,
                'type' => 'seo',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 21,
                'key' => 'site_offline',
                'description' => 'Сайт не доступен',
                'value' => '0',
                'help' => 'Внимание! Сайт будет не доступен! Пользователи будут видеть сообщение, что сайт на обслуживании!',
                'ordering' => 5,
                'type' => 'general',
                'group' => null,
                'field' => 'checkbox'
            ],
            [
                'id' => 23,
                'key' => 'admin_developers',
                'description' => 'Разработчикам',
                'value' => '1',
                'help' => 'Включить режим разработчика',
                'ordering' => 4,
                'type' => 'general',
                'group' => null,
                'field' => 'checkbox'
            ],
            [
                'id' => 24,
                'key' => 'email_support',
                'description' => 'Email для поддержки',
                'value' => 'admin@gmail.com',
                'help' => null,
                'ordering' => 7,
                'type' => 'contacts',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 28,
                'key' => 'phone2',
                'description' => 'Телефон 2',
                'value' => '+7 (654) 65-46-546',
                'help' => null,
                'ordering' => 2,
                'type' => 'contacts',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 29,
                'key' => 'list_comments_count',
                'description' => 'Число комментариев на странице',
                'value' => '10',
                'help' => '',
                'ordering' => 0,
                'type' => 'comments',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 31,
                'key' => 'instagram_token',
                'description' => 'Access Token',
                'value' => '373761376.1677ed0.454fe78112d24c85b2c55903e3b4b8a5',
                'help' => '<a href="http://instagram.pixelunion.net/" target="_blank">Сгенерировать Token</a>',
                'ordering' => 1,
                'type' => 'keys',
                'group' => 'Instagram',
                'field' => 'input'
            ],
            [
                'id' => 32,
                'key' => 'instagram_photo_amount',
                'description' => 'Кол-во фото',
                'value' => '4',
                'help' => 'Кол-во выводимых фотографий на сайте',
                'ordering' => 1,
                'type' => 'keys',
                'group' => 'Instagram',
                'field' => 'input'
            ],
            [
                'id' => 33,
                'key' => 'recaptcha_public_key',
                'description' => 'Публичный ключ',
                'value' => '',
                'help' => '',
                'ordering' => 3,
                'type' => 'keys',
                'group' => 'Recaptcha',
                'field' => 'input'
            ],
            [
                'id' => 34,
                'key' => 'recaptcha_secret_key',
                'description' => 'Секретный ключ',
                'value' => '',
                'help' => '<a href="https://www.google.com/recaptcha/admin" target="_blank">Настроить</a>',
                'ordering' => 4,
                'type' => 'keys',
                'group' => 'Recaptcha',
                'field' => 'input'
            ],
            [
                'id' => 35,
                'key' => 'google_maps_key',
                'description' => 'Ключ API Google Maps',
                'value' => 'AIzaSyDYWFd5B9y-oGk4311tpUha7WOBCuWWqu8',
                'help' => '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key?hl=ru" target="_blank">Получить ключ</a>',
                'ordering' => 4,
                'type' => 'keys',
                'group' => 'Google',
                'field' => 'input'
            ],
            [
                'id' => 46,
                'key' => 'admin_notes',
                'description' => '',
                'value' => '',
                'help' => null,
                'ordering' => 0,
                'type' => 'admin',
                'group' => null,
                'field' => 'input'
            ],
            [
                'id' => 47,
                'key' => 'yandex_key_secret',
                'description' => 'Секретный ключ Yandex.Money',
                'value' => 'WbyQHWrS9gjlRW6K3s9uO3i3',
                'help' => null,
                'ordering' => 0,
                'type' => '',
                'group' => 'YandexMoney',
                'field' => 'input',
            ],
            [
                'id' => 48,
                'key' => 'user_notification_method',
                'description' => 'Способ получения уведомлений',
                'value' => 'email',
                'help' => null,
                'ordering' => 0,
                'type' => 'user',
                'group' => '',
                'field' => 'radio',
            ],
            [
                'id' => 49,
                'key' => 'user_notification_news_events',
                'description' => 'Получать уведомления о новостях и событиях в поселке?',
                'value' => '1',
                'help' => null,
                'ordering' => 0,
                'type' => 'user',
                'group' => '',
                'field' => 'checkbox',
            ],
        ];

        DB::table('settings')->insert($data);
    }
}
