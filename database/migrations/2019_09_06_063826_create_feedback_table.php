<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->string('email', 255);
            $table->string('phone', 20)->nullable();
            $table->bigInteger('user_id')->unsigned()->default(0);
            $table->text('message');
            $table->text('attach')->nullable();
            $table->string('subject', 100);
            $table->text('answer')->nullable();
            $table->string('ip_address', 15);
            $table->enum('is_view',['0','1'])->default(0);
            $table->enum('status',['on', 'spam', 'deleted'])->default('on');
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
        Schema::dropIfExists('feedback');
    }
}
