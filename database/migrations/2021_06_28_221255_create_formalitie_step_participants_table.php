<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormalitieStepParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formalitie_step_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formalitie_id');
            $table->foreign('formalitie_id')->references('id')->on('formalities');
            $table->unsignedBigInteger('step_id');
            $table->foreign('step_id')->references('id')->on('formalitie_type_steps');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('formalitie_step_participants');
    }
}
