<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('alumni_id')->unique();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_category')->nullable();
            $table->date('establishment_date')->nullable();
            $table->string('website_url')->nullable();
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
        Schema::dropIfExists('private_companies');
    }
}
