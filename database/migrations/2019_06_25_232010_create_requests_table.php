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
            $table->bigInteger('key_id')->unsigned();
            $table->foreign('key_id')->references('id')->on('keys');
            $table->string('service');
            $table->string('manager');
            $table->string('company');
            //Id do usuário solicitante
            $table->bigInteger('usr_req_id')->unsigned();
            $table->foreign('usr_req_id')->references('id')->on('request_users');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
