<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('alumni_id')->unique();
            $table->string('employer')->nullable();
            $table->string('employer_address')->nullable();
            $table->string('employer_category')->nullable();
            $table->string('position')->nullable();
            $table->float('salary')->nullable();
            $table->date('employment_date')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('employment_info')->nullable();
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
        Schema::dropIfExists('employments');
    }
}
