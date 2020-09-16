<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSavePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_posts', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('post')->unsigned();
            $table->foreign('post')->references('id')->on('posts')->onDelete('cascade');

            $table->BigInteger('sitter')->unsigned();
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
        Schema::dropIfExists('save_posts');
    }
}
