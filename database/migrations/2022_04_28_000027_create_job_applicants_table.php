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
        Schema::create('job_applicants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->date('dob');
            $table->tinyInteger('gender_id');
            $table->string('phone')->nullable();
            $table->string('headline')->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->text('summary')->nullable();
            $table->string('resume')->nullable();
            $table->text('cover_letter')->nullable();
            $table->text('skills')->nullable();
            $table->unsignedBigInteger('job_workflow_stage_id');
            $table->tinyInteger('consideration_id');
            $table->tinyInteger('years_of_experience')->nullable();

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
        Schema::dropIfExists('job_applicants');
    }
};
