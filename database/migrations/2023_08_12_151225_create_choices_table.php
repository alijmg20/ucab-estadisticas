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
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->string('value')->nullable();
            $table->unsignedBigInteger('question_id')->nullable()->default(0);
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onDelete('set null')
                ->onUpdate('cascade');  
            $table->timestamps();        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
