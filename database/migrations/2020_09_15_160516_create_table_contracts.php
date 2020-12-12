<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableContracts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('parent')->unsigned()->nullable();
            // foreign parents
            $table->foreign('parent')->references('id')->on('parents')->onDelete('cascade');
            //
            $table->BigInteger('sitter')->unsigned()->nullable();
            // foreign sitters
            $table->foreign('sitter')->references('id')->on('sitters')->onDelete('cascade');
            //
            $table->tinyInteger('status')->nullable();
            $table->string('money')->nullable();
            $table->tinyInteger('check')->nullable();
            $table->tinyInteger('is_work')->default(0)->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
