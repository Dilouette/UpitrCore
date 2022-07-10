<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('from_user_type_id');            
            $table->tinyInteger('to_user_type_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('candidate_id');
            $table->string('subject')->nullable();
            $table->unsignedBigInteger('reply_to')->nullable();
            $table->text('body');
            $table->boolean('opened');
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
        Schema::dropIfExists('messages');
    }
};
