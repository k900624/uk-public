<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_content', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('object_name', 255)->default('articles');
            $table->bigInteger('object_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('tag_id')
                ->references('id')->on('tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_content');
    }
}
