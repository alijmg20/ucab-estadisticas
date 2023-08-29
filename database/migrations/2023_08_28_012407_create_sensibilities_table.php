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
        Schema::create('sensibilities', function (Blueprint $table) {
            $table->id();
            $table->integer('positive');
            $table->integer('negative');
            $table->integer('neutral');
            $table->integer('count');
            $table->unsignedBigInteger('variable_id');
            
            $table->foreign('variable_id')
                ->references('id')
                ->on('variables')
                ->onDelete('cascade')
                ->onUpdate(' cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensibilities');
    }
};
