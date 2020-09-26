<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->unsigned()->default(0);
            $table->bigInteger('group_id')->unsigned();
            $table->string('type', 50);
            $table->bigInteger('page_id')->unsigned();
            $table->string('title');
            $table->string('link');
            $table->string('icon', 50);
            $table->enum('published',['0','1'])->default(1);
            $table->tinyInteger('ordering')->default(0);
            //$table->foreign('parent_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
