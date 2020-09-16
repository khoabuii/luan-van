<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableImgSitters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_sitters', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('sitter_id')->unsigned();
            // foreign sitters
            $table->foreign('sitter_id')->references('id')->on('sitters')->onDelete('cascade');
            //
            $table->string('img')->nullable();
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
        Schema::dropIfExists('img_sitters');
    }
}
