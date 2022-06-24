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
            $table->string('location');
            $table->string('meeting_url');
            $table->tinyInteger('related_to_id');
            $table->tinyInteger('importance_id');
            $table->text('description');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->unsignedBigInteger('job_applicant_id')->nullable();
            $table->unsignedBigInteger('job_id')->nullable();

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
        Schema::dropIfExists('activities');
    }
};
