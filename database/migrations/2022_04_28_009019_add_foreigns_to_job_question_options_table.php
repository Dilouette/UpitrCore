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
        Schema::table('job_question_options', function (Blueprint $table) {
            $table
                ->foreign('job_question_id')
                ->references('id')
                ->on('job_questions')
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
        Schema::table('job_question_options', function (Blueprint $table) {
            $table->dropForeign(['job_question_id']);
        });
    }
};
