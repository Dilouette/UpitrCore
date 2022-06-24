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
        Schema::table('assesment_questions', function (Blueprint $table) {
            $table
                ->foreign('assesment_id')
                ->references('id')
                ->on('assesments')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('question_type_id')
                ->references('id')
                ->on('question_types')
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
        Schema::table('assesment_questions', function (Blueprint $table) {
            $table->dropForeign(['assesment_id']);
            $table->dropForeign(['question_type_id']);
        });
    }
};
