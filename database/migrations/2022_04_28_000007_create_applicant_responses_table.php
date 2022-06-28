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
        Schema::create('applicant_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_applicant_id');
            $table->unsignedBigInteger('job_question_id');
            $table->text('response')->nullable();
            $table->unsignedBigInteger('job_question_option_id')->nullable();

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
        Schema::dropIfExists('applicant_responses');
    }
};
