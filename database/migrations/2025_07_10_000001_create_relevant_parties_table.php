<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelevantPartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relevant_parties', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('gender')->nullable();
            $table->string('relationship');
            $table->string('nationality')->nullable();
            $table->text('statement')->nullable();
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
        Schema::dropIfExists('relevant_parties');
    }
}