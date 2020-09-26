<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('group_id')->unsigned();
            $table->string('title')->unsigned();
            $table->text('description');
            $table->string('unit', 10);
            $table->string('price');
            $table->string('name_company')->nullable();
            $table->string('phone', 50)->nullable();
            $table->text('address')->nullable();
            $table->enum('published',['0','1'])->default(1);
            $table->string('url')->nullable();
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
        Schema::dropIfExists('services');
    }
}
