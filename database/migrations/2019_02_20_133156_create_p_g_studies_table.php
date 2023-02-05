<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePGStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_g_studies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('alumni_id');
            $table->string('degree')->nullable();
            $table->string('specialization')->nullable();
            $table->string('granting_organization')->nullable();
            $table->string('address')->nullable();
            $table->string('university')->nullable();
            $table->string('enrolment_year')->nullable();
            $table->string('graduation_year')->nullable();
            $table->string('goals_achieved')->nullable();
            $table->foreign('alumni_id')->references('id')->on('alumnis')->onDelete('cascade');
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
        Schema::dropIfExists('p_g_studies');
    }
}
