<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('object_name', 255)->nullable();
            $table->bigInteger('object_id')->unsigned();
            $table->string('file_name', 255);
            $table->string('title', 255);
            $table->string('mime_type', 255);
            $table->bigInteger('size')->unsigned();
            $table->enum('main',['0','1'])->default('0');
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
        Schema::dropIfExists('images');
    }
}
