<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('alias');
            $table->bigInteger('cat_id')->unsigned()->default(0);
            $table->text('introtext')->nullable();
            $table->mediumText('fulltext');
            $table->text('image')->nullable();
            $table->bigInteger('created_by')->unsigned()->default(1);
            $table->bigInteger('updated_by')->unsigned()->default(1);
            $table->enum('published',['0','1'])->default(1);
            $table->text('metakey')->nullable();
            $table->text('metadesc')->nullable();
            $table->enum('enable_comments',['0','1'])->default(1);
            $table->timestamps();
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
        Schema::dropIfExists('content');
    }
}
