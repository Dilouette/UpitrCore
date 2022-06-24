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
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table
                ->string('code')
                ->nullable()
                ->unique();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_remote')->nullable();
            $table->text('description');
            $table->text('requirements');
            $table->text('benefit')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->integer('industry_id')->nullable();
            $table->integer('job_function_id')->nullable();
            $table->integer('employment_type_id')->nullable();
            $table->integer('experience_level_id')->nullable();
            $table->integer('education_level_id')->nullable();
            $table->text('keywords')->nullable();
            $table->decimal('salary_min')->nullable();
            $table->decimal('salary_max')->nullable();
            $table->integer('salary_currency_id')->nullable();
            $table->smallInteger('head_count')->nullable();
            $table->bigInteger('created_by');
            $table->boolean('is_published');
            $table->dateTime('deadline');
            $table->unsignedBigInteger('job_workflow_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
