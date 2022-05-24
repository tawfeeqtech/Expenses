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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('currency');
            $table->string('balance');

            $table->foreignId('wallet_id')->constrained();

            $table->foreignId('section_id')->nullable()->constrained();
            $table->foreignId('subsection_id')->nullable()->constrained();
            $table->string('notes')->nullable();
            $table->date('date');
            $table->foreignId('contact_id')->nullable()->constrained();

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
        Schema::dropIfExists('treatments');
    }
};
