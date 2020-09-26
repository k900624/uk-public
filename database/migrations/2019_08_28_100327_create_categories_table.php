<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->unsigned()->default(0);
            $table->string('title');
            $table->string('alias');
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->text('metakey')->nullable();
            $table->text('metadesc')->nullable();
            $table->enum('published',['0','1'])->default(1);
            $table->tinyInteger('ordering')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
