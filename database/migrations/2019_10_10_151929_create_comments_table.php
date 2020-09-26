<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('object_name', 255);
            $table->bigInteger('object_id')->unsigned();
            $table->text('message');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->bigInteger('created_by')->unsigned();
            $table->string('ip_address', 15);
            $table->enum('is_view',['0','1'])->default('0');
            $table->enum('status',['off','on','deleted'])->default('off');
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
        Schema::dropIfExists('comments');
    }
}
