<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('alumni_id');
            $table->string('programme');
            $table->string('request_type');
            $table->date('request_date');
            $table->string('address_name')->nullable();
            $table->string('address_pobox')->nullable();
            $table->string('address_town')->nullable();
            $table->string('address_region')->nullable();
            $table->string('address_country')->nullable();
            $table->string('status')->default("Pending...");
            $table->string('traking_number')->default("null");
            $table->string('rejectionReason')->default("null");
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
        Schema::dropIfExists('document_requests');
    }
}
