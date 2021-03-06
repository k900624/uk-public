<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        
            ['id' => 1, 'key' => 'browse_dashboard', 'table_name' => NULL, 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 2, 'key' => 'browse_systems', 'table_name' => NULL, 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 3, 'key' => 'browse_databases', 'table_name' => NULL, 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 4, 'key' => 'browse_commands', 'table_name' => NULL, 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 5, 'key' => 'browse_logs', 'table_name' => NULL, 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 7, 'key' => 'browse_statistics', 'table_name' => NULL, 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 8, 'key' => 'browse_hits', 'table_name' => NULL, 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 9, 'key' => 'browse_searches', 'table_name' => NULL, 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 10, 'key' => 'browse_menus', 'table_name' => 'menus', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 11, 'key' => 'create_menus', 'table_name' => 'menus', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 12, 'key' => 'store_menus', 'table_name' => 'menus', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 13, 'key' => 'edit_menus', 'table_name' => 'menus', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 14, 'key' => 'update_menus', 'table_name' => 'menus', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 15, 'key' => 'delete_menus', 'table_name' =>'menus', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 16, 'key' => 'activate_menus', 'table_name' =>'menus', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 17, 'key' => 'deactivate_menus', 'table_name' => 'menus', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 18, 'key' => 'browse_roles', 'table_name' => 'roles', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 19, 'key' => 'create_roles', 'table_name' => 'roles', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 20, 'key' => 'store_roles', 'table_name' => 'roles', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 21, 'key' => 'edit_roles', 'table_name' => 'roles', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 22, 'key' => 'update_roles', 'table_name' => 'roles', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 23, 'key' => 'delete_roles', 'table_name' => 'roles', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 24, 'key' => 'browse_users', 'table_name' => 'users', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 25, 'key' => 'create_users', 'table_name' => 'users', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 26, 'key' => 'store_users', 'table_name' => 'users', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 27, 'key' => 'edit_users', 'table_name' => 'users', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 28, 'key' => 'update_users', 'table_name' => 'users', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 29, 'key' => 'delete_users', 'table_name' => 'users', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 30, 'key' => 'activate_users', 'table_name' => 'users', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 31, 'key' => 'deactivate_users', 'table_name' => 'users', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 32, 'key' => 'browse_settings', 'table_name' => 'settings', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 33, 'key' => 'update_settings', 'table_name' => 'settings', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 34, 'key' => 'browse_categories', 'table_name' => 'categories', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 35, 'key' => 'create_categories', 'table_name' => 'categories', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 36, 'key' => 'store_categories', 'table_name' => 'categories', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 37, 'key' => 'edit_categories', 'table_name' => 'categories', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 38, 'key' => 'update_categories', 'table_name' => 'categories', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 39, 'key' => 'delete_categories', 'table_name' => 'categories', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 40, 'key' => 'activate_categories', 'table_name' => 'categories', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 41, 'key' => 'deactivate_categories', 'table_name' => 'categories', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 42, 'key' => 'browse_articles', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 43, 'key' => 'create_articles', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 44, 'key' => 'store_articles', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 45, 'key' => 'edit_articles', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 46, 'key' => 'update_articles', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 47, 'key' => 'delete_articles', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 48, 'key' => 'activate_articles', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 49, 'key' => 'deactivate_articles', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 50, 'key' => 'browse_pages', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 51, 'key' => 'create_pages', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 52, 'key' => 'store_pages', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 53, 'key' => 'edit_pages', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 54, 'key' => 'update_pages', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 55, 'key' => 'delete_pages', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 56, 'key' => 'activate_pages', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 57, 'key' => 'deactivate_pages', 'table_name' => 'content', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 58, 'key' => 'browse_comments', 'table_name' => 'comments', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 59, 'key' => 'show_comments', 'table_name' => 'comments', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 60, 'key' => 'update_comments', 'table_name' => 'comments', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 61, 'key' => 'delete_comments', 'table_name' => 'comments', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 62, 'key' => 'activate_comments', 'table_name' => 'comments', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 63, 'key' => 'deactivate_comments', 'table_name' => 'comments', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 64, 'key' => 'restore_comments', 'table_name' => 'comments', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 65, 'key' => 'force_delete_comments', 'table_name' => 'comments', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 77, 'key' => 'browse_feedback', 'table_name' => 'feedback', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 78, 'key' => 'show_feedback', 'table_name' => 'feedback', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 79, 'key' => 'store_feedback', 'table_name' => 'feedback', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 80, 'key' => 'spam_feedback', 'table_name' => 'feedback', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 81, 'key' => 'restore_feedback', 'table_name' => 'feedback', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 82, 'key' => 'delete_feedback', 'table_name' => 'feedback', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 83, 'key' => 'force_delete_feedback', 'table_name' => 'feedback', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 84, 'key' => 'browse_faqs', 'table_name' => 'faq', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 85, 'key' => 'create_faqs', 'table_name' => 'faq', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 86, 'key' => 'store_faqs', 'table_name' => 'faq', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 87, 'key' => 'edit_faqs', 'table_name' => 'faq', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 88, 'key' => 'update_faqs', 'table_name' => 'faq', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 89, 'key' => 'delete_faqs', 'table_name' => 'faq', 'created_at' => '2019-05-22 12:23:23', 'updated_at' => '2019-05-22 12:23:23'],
            ['id' => 90, 'key' => 'activate_faqs', 'table_name' => 'faq', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 91, 'key' => 'deactivate_faqs', 'table_name' => 'faq', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 158, 'key' => 'create_menu_groups', 'table_name' => 'menu_groups', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 159, 'key' => 'store_menu_groups', 'table_name' =>'menu_groups', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 160, 'key' => 'edit_menu_groups', 'table_name' => 'menu_groups', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 161, 'key' => 'update_menu_groups', 'table_name' => 'menu_groups', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 162, 'key' => 'delete_menu_groups', 'table_name' => 'menu_groups', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 164, 'key' => 'edit_accounts', 'table_name' => 'users', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 165, 'key' => 'update_accounts', 'table_name' => 'users', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 166, 'key' => 'create_faq_categories', 'table_name' => 'faq_category', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 167, 'key' => 'store_faq_categories', 'table_name' => 'faq_category', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 168, 'key' => 'edit_faq_categories', 'table_name' => 'faq_category', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 169, 'key' => 'update_faq_categories', 'table_name' => 'faq_category', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 170, 'key' => 'delete_faq_categories', 'table_name' => 'faq_category', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 171, 'key' => 'browse_feeds', 'table_name' => 'activities', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 172, 'key' => 'delete_all_feeds', 'table_name' => 'activities', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 173, 'key' => 'banned_users', 'table_name' => 'users', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 182, 'key' => 'notify_users', 'table_name' => 'abuses', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 183, 'key' => 'browse_abuses', 'table_name' => 'abuses', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 184, 'key' => 'show_abuses', 'table_name' => 'abuses', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 185, 'key' => 'delete_abuses', 'table_name' => 'abuses', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            ['id' => 186, 'key' => 'invite_users', 'table_name' => 'users', 'created_at' => '2019-05-11 17:10:02', 'updated_at' => '2019-05-11 17:10:02'],
            
        ];
        
        DB::table('permissions')->insert($data);
    }

}
