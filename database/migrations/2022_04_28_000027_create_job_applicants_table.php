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
            $table->integer('job_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('headline')->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->text('summary')->nullable();
            $table->string('resume')->nullable();
            $table->text('cover_letter')->nullable();
            $table->text('cv')->nullable();
            $table->unsignedBigInteger('job_workflow_stage_id');
            $table->tinyInteger('consideration_id');

            $table->timestamps();
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
