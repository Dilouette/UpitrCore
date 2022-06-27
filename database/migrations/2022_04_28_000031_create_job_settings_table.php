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
        Schema::create('job_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id');
            $table->enum('firstname', ['Mandatory'])->default('Mandatory');
            $table->enum('lastname', ['Mandatory'])->default('Mandatory');
            $table->enum('email', ['Mandatory'])->default('Mandatory');
            $table
                ->enum('phone', ['Mandatory', 'Optional', 'Off'])
                ->default('Mandatory');
            $table
                ->enum('heading', ['Mandatory', 'Optional', 'Off'])
                ->default('Mandatory');
            $table
                ->enum('address', ['Mandatory', 'Optional', 'Off'])
                ->default('Mandatory');
            $table
                ->enum('photo', ['Mandatory', 'Optional', 'Off'])
                ->default('Mandatory');
            $table->enum('education', ['Mandatory','Optional', 'Off'])->default('Optional');
            $table
                ->enum('experience', ['Mandatory','Optional', 'Off'])
                ->default('Optional');
            $table
                ->enum('summary', ['Mandatory', 'Optional', 'Off'])
                ->default('Mandatory');
            $table
                ->enum('resume', ['Mandatory', 'Optional', 'Off'])
                ->default('Mandatory');
            $table
                ->enum('cover_letter', ['Mandatory', 'Optional', 'Off'])
                ->default('Mandatory');
            $table->enum('cv', ['Mandatory', 'Optional', 'Off']);

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
        Schema::dropIfExists('job_settings');
    }
};
