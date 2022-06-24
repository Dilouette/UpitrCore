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
        Schema::table('jobs', function (Blueprint $table) {
            $table
                ->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('region_id')
                ->references('id')
                ->on('regions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('industry_id')
                ->references('id')
                ->on('industries')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('job_function_id')
                ->references('id')
                ->on('job_functions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('employment_type_id')
                ->references('id')
                ->on('employment_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('experience_level_id')
                ->references('id')
                ->on('experience_levels')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('education_level_id')
                ->references('id')
                ->on('education_levels')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('salary_currency_id')
                ->references('id')
                ->on('currencies')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

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
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropForeign(['region_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['industry_id']);
            $table->dropForeign(['job_function_id']);
            $table->dropForeign(['employment_type_id']);
            $table->dropForeign(['experience_level_id']);
            $table->dropForeign(['education_level_id']);
            $table->dropForeign(['salary_currency_id']);
            $table->dropForeign(['job_workflow_id']);
        });
    }
};
