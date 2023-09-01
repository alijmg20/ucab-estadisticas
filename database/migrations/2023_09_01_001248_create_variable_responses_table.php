<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('variable_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variable_id');
            $table->unsignedBigInteger('variable_option_id');
            $table->unsignedBigInteger('register_id'); // Agrega el campo
            $table->timestamps();

            $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade');
            $table->foreign('variable_option_id')->references('id')->on('variable_options')->onDelete('cascade');
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variable_responses');
    }
};
