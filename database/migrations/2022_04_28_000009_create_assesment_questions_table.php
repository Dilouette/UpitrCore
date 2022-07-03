<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesment_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('assesment_id');
            $table->text('question');
            $table->unsignedSmallInteger('question_type_id');
            $table->string('answer')->nullable();

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
        Schema::dropIfExists('assesment_questions');
    }
};
