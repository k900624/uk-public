<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();
        
        $data = [
            
        ];
        
        DB::table('permission_role')->insert($data);

        Schema::enableForeignKeyConstraints();
    }

}
