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
        Schema::table('interview_questions', function (Blueprint $table) {
            $table
                ->foreign('interview_section_id')
                ->references('id')
                ->on('interview_sections')
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
        Schema::table('interview_questions', function (Blueprint $table) {
            $table->dropForeign(['interview_section_id']);
        });
    }
};
