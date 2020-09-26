<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('ip_address', 15);
            $table->string('password');
            $table->string('api_token')->unique()->nullable()->default(null);
            $table->rememberToken();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('invited_at')->nullable();
            $table->tinyInteger('invite_attempts')->default(0);
            $table->timestamps();
            $table->enum('status',['off','on','banned','deleted'])->default('on');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
