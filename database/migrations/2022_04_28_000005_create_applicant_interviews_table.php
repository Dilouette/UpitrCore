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
        Schema::create('applicant_interviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_applicant_id');
            $table->smallInteger('score');
            $table->text('feedback');
            $table->dateTime('start_time');
            $table->dateTime('end_time');

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
        Schema::dropIfExists('applicant_interviews');
    }
};
