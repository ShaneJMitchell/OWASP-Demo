<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Boxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->date('sent')->nullable();
            $table->timestamps();
        });

        Schema::create('box_user', function (Blueprint $table) {
            $table->unsignedBigInteger( 'user_id');
            $table->unsignedInteger( 'box_id');
            $table->string('delivery_status');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('box_id')->references('id')->on('boxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxes');
        Schema::dropIfExists('box_user');
    }
}
