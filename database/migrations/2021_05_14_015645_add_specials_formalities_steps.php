<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpecialsFormalitiesSteps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formalitie_type_steps', function (Blueprint $table) {
            $table->tinyInteger('min_days')->nullable();
            $table->tinyInteger('max_days')->nullable();
            $table->unsignedBigInteger('aprobation_type_id')->nullable();
            $table->foreign('aprobation_type_id')->references('id')->on('aprobation_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
