<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSaveSitters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_sitters', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('parent')->unsigned()->nullable();
            // foreign parent
            $table->foreign('parent')->references('id')->on('parents')->onDelete('cascade');
            //
            $table->BigInteger('sitter')->unsigned()->nullable();
            // foreign sitter
            $table->foreign('sitter')->references('id')->on('sitters')->onDelete('cascade');
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
        Schema::dropIfExists('save_sitters');
    }
}
