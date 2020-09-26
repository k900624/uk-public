<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('key')->unique();
            $table->text('description')->nullable()->default(null);
            $table->text('value')->nullable();
            $table->string('help', 255)->nullable();
            $table->string('type', 50);
            $table->string('group', 50)->nullable();
            $table->string('field', 50)->default('input');
            $table->tinyInteger('ordering')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
