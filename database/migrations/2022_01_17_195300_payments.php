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
            $table->id('id');
            $table->unsignedBigInteger('id_walltet');
            $table->double('value', 8, 2);
            $table->string('description');
            $table->string('code');
            $table->boolean('confirm')->default(false);
            $table->unsignedBigInteger('id_user_payments');
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
        Schema::dropIfExists('payments');
    }
}
