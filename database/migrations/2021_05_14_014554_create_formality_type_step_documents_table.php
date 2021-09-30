<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormalityTypeStepDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formality_type_step_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formality_type_step_id');
            $table->foreign('formality_type_step_id')->references('id')->on('formalitie_type_steps')->onDelete('cascade');
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')->references('id')->on('documents');
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
        Schema::dropIfExists('formality_type_step_documents');
    }
}
