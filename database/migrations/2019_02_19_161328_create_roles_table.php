<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('role')->unique();
            $table->timestamps();
            
        });
        
        DB::table('roles')->insert(
            array(
                ['id' => '6c32aada-6e65-4548-a703-3176d5719490',
                'role' => 'Admin'
                ],
                ['id' => '534f2ff7-96e2-48df-b379-de8117c69086',
                'role' => 'Alumni'
                ],
                ['id' => 'Str::orderedUuid()->toString()',
                'role' => 'Department Head'
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
