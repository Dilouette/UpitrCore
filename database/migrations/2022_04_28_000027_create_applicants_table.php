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
        Schema::create('applicants', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('candidate_id');
            $table->text('cover_letter')->nullable();
            $table->unsignedBigInteger('job_workflow_stage_id');

            $table->text('interview_feedback')->nullable();
            $table->decimal('interview_score')->nullable();
            $table->decimal('assesment_score')->nullable();
            $table->decimal('assesment_pass_score')->nullable();

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
        Schema::dropIfExists('applicants');
    }
};
