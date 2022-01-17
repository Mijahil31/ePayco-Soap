<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Payments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('id_walltet')->unsigned();
            $table->float('value');
            $table->string('description');
            $table->uuid('id_user_payments')->unsigned();
            $table->timestamps();
            $table->foreign('id_walltet')->references('id')->on('wallet');
            $table->foreign('id_user_payments')->references('id')->on('users');
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
