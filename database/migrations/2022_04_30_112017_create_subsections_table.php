<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsections', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');

//            $table->integer('section_id')->unsigned()->nullable();


            $table->foreignId('section_id')->constrained();

            $table->timestamps();

//            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subsections');
    }
};
