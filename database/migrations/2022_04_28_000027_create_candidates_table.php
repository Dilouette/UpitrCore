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
        Schema::create('candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('email')->unique();
            $table->date('dob')->nullable();
            $table->tinyInteger('gender_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('headline')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->text('summary')->nullable();
            $table->string('resume')->nullable();
            $table->text('skills')->nullable();
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->unsignedBigInteger('job_function_id')->nullable();
            $table->tinyInteger('years_of_experience')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->boolean('reset_login')->default(false)->nullable();
            $table->boolean('first_login')->default(true)->nullable();
            $table->dateTime('last_login')->nullable();
            $table->boolean('is_active')->default(true)->nullable();

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
        Schema::dropIfExists('candidates');
    }
};
