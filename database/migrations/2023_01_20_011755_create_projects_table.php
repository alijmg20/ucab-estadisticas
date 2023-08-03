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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('slug');
            $table->enum('status',[1,2])->default(1); //1 No publicado //2 publicado
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('line_id')->nullable();
            
            $table->foreign('user_id')
                   ->references('id')
                   ->on('users')
                   ->onDelete('set null')
                   ->onUpdate('set null');           

            $table->foreign('line_id')
            ->references('id')
            ->on('lines')
            ->onDelete('set null')
            ->onUpdate('set null');           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
