<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFeedbackParents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_parents', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('parent')->unsigned()->nullable();
            // foreign parents
            $table->foreign('parent')->references('id')->on('parents')->onDelete('cascade');
            //
            $table->BigInteger('sitter')->unsigned()->nullable();
            // foreign sitters
            $table->foreign('sitter')->references('id')->on('sitters')->onDelete('cascade');
            //
            $table->tinyInteger('rate_parent')->nullable();
            $table->text('content_parent')->nullable();
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
        Schema::dropIfExists('feedback_parents');
    }
}
