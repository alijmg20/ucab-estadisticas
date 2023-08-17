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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer')->nullable();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('quiz_user_id')->nullable()->default(0); //-1 eliminado 0 usuario anonimo
            $table->foreign('question_id')
            ->references('id')
            ->on('questions')
            ->onDelete('cascade')
            ->onUpdate('cascade');   
            $table->foreign('quiz_user_id')
            ->references('id')
            ->on('quiz_user')
            ->onDelete('set null')
            ->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
