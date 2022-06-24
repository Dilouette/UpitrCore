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
        Schema::table('assesment_responses', function (Blueprint $table) {
            $table
                ->foreign('applicant_assesment_id')
                ->references('id')
                ->on('applicant_assesments')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('assesment_question_id')
                ->references('id')
                ->on('assesment_questions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('assesment_question_option_id')
                ->references('id')
                ->on('assesment_question_options')
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
        Schema::table('assesment_responses', function (Blueprint $table) {
            $table->dropForeign(['applicant_assesment_id']);
            $table->dropForeign(['assesment_question_id']);
            $table->dropForeign(['assesment_question_option_id']);
        });
    }
};
