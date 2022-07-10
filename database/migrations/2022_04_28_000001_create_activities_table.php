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
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('activity_type_id');
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('location')->nullable();
            $table->string('meeting_url')->nullable();
            $table->tinyInteger('related_to_id');
            $table->tinyInteger('importance_id');
            $table->tinyInteger('status_id');
            $table->text('description');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->unsignedBigInteger('applicant_id')->nullable();
            $table->unsignedBigInteger('job_id')->nullable();

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
        Schema::dropIfExists('activities');
    }
};
