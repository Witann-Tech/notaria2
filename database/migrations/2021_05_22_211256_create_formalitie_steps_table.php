<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormalitieStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formalitie_steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formalitie_id');
            $table->foreign('formalitie_id')->references('id')->on('formalities');
            $table->unsignedBigInteger('formalitie_type_step_id');
            $table->foreign('formalitie_type_step_id')->references('id')->on('formalitie_type_steps');
            $table->unsignedBigInteger('step_status_id');
            $table->foreign('step_status_id')->references('id')->on('step_statuses');
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
        Schema::dropIfExists('formalitie_steps');
    }
}
