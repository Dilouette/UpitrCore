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
        Schema::table('experiences', function (Blueprint $table) {
            $table
                ->foreign('candidate_id')
                ->references('id')
                ->on('candidates')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table
                ->foreign('industry_id')
                ->references('id')
                ->on('industries')
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
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropForeign(['candidate_idg']);
            $table->dropForeign(['industry_id']);
        });
    }
};
