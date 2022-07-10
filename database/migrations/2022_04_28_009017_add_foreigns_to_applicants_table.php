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
        Schema::table('applicants', function (Blueprint $table) {
            $table
                ->foreign('job_id')
                ->references('id')
                ->on('jobs')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('candidate_id')
                ->references('id')
                ->on('candidates')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('job_workflow_stage_id')
                ->references('id')
                ->on('job_workflow_stages')
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
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
            $table->dropForeign(['candidate_id']);
            $table->dropForeign(['job_workflow_stage_id']);
        });
    }
};
