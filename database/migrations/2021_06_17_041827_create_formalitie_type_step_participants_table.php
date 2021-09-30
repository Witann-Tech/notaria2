<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormalitieTypeStepParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formalitie_type_step_participants', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("quantity")->default(1);
            $table->unsignedBigInteger('step_id');
            $table->foreign('step_id')->references('id')->on('formalitie_type_steps');
            $table->unsignedBigInteger('participant_type_id');
            $table->foreign('participant_type_id')->references('id')->on('participant_types');
            $table->unsignedBigInteger('formalitie_type_id');
            $table->foreign('formalitie_type_id')->references('id')->on('formalitie_types');
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
        Schema::dropIfExists('formalitie_type_step_participants');
    }
}
