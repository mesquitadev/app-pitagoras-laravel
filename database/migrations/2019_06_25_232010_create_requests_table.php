<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('barcode');
            $table->string('cpf');
            $table->string('username');
            $table->string('phone');
            $table->string('key');
            $table->string('type');
            $table->string('service');
            $table->string('company');
            $table->string('manager');
            //Get User Authenticated id
            $table->string('concierge');
            $table->dateTime('loan_date')->default(\Carbon\Carbon::now());
            $table->dateTime('devolution_date')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
