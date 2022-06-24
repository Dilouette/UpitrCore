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
        Schema::table('applicant_experiences', function (Blueprint $table) {
            $table
                ->foreign('job_applicant_id')
                ->references('id')
                ->on('job_applicants')
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
        Schema::table('applicant_experiences', function (Blueprint $table) {
            $table->dropForeign(['job_applicant_id']);
        });
    }
};
