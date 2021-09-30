<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormalitiesStepFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formalities_step_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formalitie_id');
            $table->foreign('formalitie_id')->references('id')->on('formalities');
            $table->unsignedBigInteger('formalitie_step_id');
            $table->foreign('formalitie_step_id')->references('id')->on('formalitie_steps');
            $table->string('file');
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
        Schema::dropIfExists('formalities_step_files');
    }
}
