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
        Schema::table('applicant_interview_feedbacks', function (
            Blueprint $table
        ) {
            $table
                ->foreign('applicant_interview_id')
                ->references('id')
                ->on('applicant_interviews')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('inteview_question_id')
                ->references('id')
                ->on('inteview_questions')
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
        Schema::table('applicant_interview_feedbacks', function (
            Blueprint $table
        ) {
            $table->dropForeign(['applicant_interview_id']);
            $table->dropForeign(['inteview_question_id']);
        });
    }
};
