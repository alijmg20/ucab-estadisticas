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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('ext');
            $table->enum('status',[1,2])->default(1); //1 No publicado //2 publicado
            $table->unsignedBigInteger('project_id');
            $table->timestamps();
            $table->foreign('project_id')
            ->references('id')
            ->on('projects')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
