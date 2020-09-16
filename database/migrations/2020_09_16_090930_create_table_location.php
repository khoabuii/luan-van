<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLocation extends Migration
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
            $table->string('district')->nullable();
            $table->string('city')->nullable();
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
