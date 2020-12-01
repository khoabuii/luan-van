<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->BigInteger('sitter')->unsigned()->nullable();
            // foreign sitters
            $table->foreign('sitter')->references('id')->on('sitters')->onDelete('cascade');
            //

            $table->bigInteger('parent')->unsigned()->nullable();
            $table->foreign('parent')->references('id')->on('parents')->onDelete('cascade');

            $table->BigInteger('posts')->unsigned()->nullable();
            // foreign post
            $table->foreign('posts')->references('id')->on('posts')->onDelete('cascade');
            //
            $table->text('content')->nullable();
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
        Schema::dropIfExists('comments');
    }
}
