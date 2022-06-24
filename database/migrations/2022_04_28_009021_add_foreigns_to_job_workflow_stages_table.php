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
        Schema::table('job_workflow_stages', function (Blueprint $table) {
            $table
                ->foreign('job_workflow_id')
                ->references('id')
                ->on('job_workflows')
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
        Schema::table('job_workflow_stages', function (Blueprint $table) {
            $table->dropForeign(['job_workflow_id']);
        });
    }
};
