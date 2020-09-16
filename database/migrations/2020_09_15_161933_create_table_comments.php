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
            $table->BigInteger('sitter')->unsigned();
            // foreign sitters
            $table->foreign('sitter')->references('id')->on('sitters')->onDelete('cascade');
            //

            $table->BigInteger('parent_post')->unsigned();
            // foreign post
            $table->foreign('parent_post')->references('id')->on('posts')->onDelete('cascade');
            //
            $table->text('content');
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
