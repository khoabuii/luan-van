<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFeedbackSitters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_sitters', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('parent')->unsigned()->nullable();
            // foreign parents
            $table->foreign('parent')->references('id')->on('parents')->onDelete('cascade');
            //
            $table->BigInteger('sitter')->unsigned()->nullable();
            // foreign sitters
            $table->foreign('sitter')->references('id')->on('sitters')->onDelete('cascade');
            //
            $table->tinyInteger('rate_sitter')->nullable();
            $table->text('content_sitter')->nullable();
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
        Schema::dropIfExists('feedback');
    }
}
