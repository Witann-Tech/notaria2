<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormalitieCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //QUIZA NO SE OCUPE
        /* Schema::create('formalitie_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');//abogado
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->timestamps();
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* Schema::dropIfExists('formalitie_customers'); */
    }
}
