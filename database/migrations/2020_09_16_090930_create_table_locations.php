<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('sitter')->unsigned()->nullable();
            // foreign sitters
            $table->foreign('sitter')->references('id')->on('sitters')->onDelete('cascade');
            //

            $table->BigInteger('parent')->unsigned()->nullable();
            //foreign parent
            $table->foreign('parent')->references('id')->on('parents')->onDelete('cascade');
            //
            $table->string('address')->nullable();
            //ward
            $table->bigInteger('ward')->unsigned()->nullable();
            $table->foreign('ward')->references('id')->on('wards')->onDelete('cascade');
            //district
            $table->bigInteger('district')->unsigned()->nullable();
            $table->foreign('district')->references('id')->on('districts')->onDelete('cascade');
            //city
            $table->bigInteger('city')->unsigned()->nullable();
            $table->foreign('city')->references('id')->on('provinces')->onDelete('cascade');
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
        Schema::dropIfExists('location');
    }
}
