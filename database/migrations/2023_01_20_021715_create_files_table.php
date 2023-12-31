<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nombre del documento
            $table->string('url'); // url del documento
            $table->enum('status',[1,2]); //1 : no utilizado 2 : utilizado
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
                   ->references('id')
                   ->on('projects')
                   ->onDelete('cascade')
                   ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
};
