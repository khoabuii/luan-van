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
            $table->BigInteger('sitter')->unsigned()->nullable();
            // foreign sitter
            $table->foreign('sitter')->references('id')->on('sitters')->onDelete('cascade');
            //
            $table->bigInteger('parent')->unsigned()->nullable();
            $table->foreign('parent')->references('id')->on('parents')->onDelete('cascade');

            $table->boolean('session1')->default(0)->nullable();
            $table->boolean('session2')->default(0)->nullable();
            $table->boolean('session3')->default(0)->nullable();
            $table->boolean('session4')->default(0)->nullable();
            $table->boolean('session5')->default(0)->nullable();
            $table->boolean('session6')->default(0)->nullable();
            $table->boolean('session7')->default(0)->nullable();
            $table->boolean('session8')->default(0)->nullable();
            $table->boolean('session9')->default(0)->nullable();
            $table->boolean('session10')->default(0)->nullable();
            $table->boolean('session11')->default(0)->nullable();
            $table->boolean('session12')->default(0)->nullable();
            $table->boolean('session13')->default(0)->nullable();
            $table->boolean('session14')->default(0)->nullable();
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
