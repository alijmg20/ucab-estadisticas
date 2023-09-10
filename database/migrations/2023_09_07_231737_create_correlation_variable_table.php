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
        Schema::create('correlation_variable', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('correlation_id');
            $table->unsignedBigInteger('variable_id');
            $table->timestamps();
            
            $table->foreign('correlation_id')->references('id')->on('correlations')->onDelete('cascade');
            $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('correlation_variable');
    }
};
