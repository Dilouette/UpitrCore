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
        Schema::table('applicant_responses', function (Blueprint $table) {
            $table
                ->foreign('job_applicant_id')
                ->references('id')
                ->on('job_applicants')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('job_question_id')
                ->references('id')
                ->on('job_questions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('job_question_option_id')
                ->references('id')
                ->on('job_question_options')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicant_responses', function (Blueprint $table) {
            $table->dropForeign(['job_applicant_id']);
            $table->dropForeign(['job_question_id']);
            $table->dropForeign(['job_question_option_id']);
        });
    }
};
