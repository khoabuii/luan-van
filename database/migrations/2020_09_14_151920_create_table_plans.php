<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('sitter')->unsigned();
            // foreign sitter
            $table->foreign('sitter')->references('id')->on('sitters')->onDelete('cascade');
            //
            $table->text('description')->nullable();
            $table->bigInteger('calendar')->unsigned()->nullable();
            // foreign sitter
            $table->foreign('calendar')->references('id')->on('calendar')->onDelete('cascade');

            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
