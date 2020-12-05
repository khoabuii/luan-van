<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSkillSitter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_sitter', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sitter')->unsigned()->nullable();
            $table->foreign('sitter')->references('id')->on('sitters')->onDelete('cascade');

            $table->bigInteger('skill')->unsigned()->nullable();
            $table->foreign('skill')->references('id')->on('skill')->onDelete('cascade');
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
        Schema::dropIfExists('skill_sitter');
    }
}
