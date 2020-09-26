<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ContentSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(MenuGroupsSeeder::class);
        $this->call(MenusSeeder::class);
        $this->call(UserProfileSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(FaqCategoryTableSeeder::class);
        $this->call(FaqTableSeeder::class);
        $this->call(AdminTodoSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(UserAreaSeeder::class);
    }
}
