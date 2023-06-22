<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('subject')->nullable();
            $table->longText('message')->nullable();
            $table->enum('status',[1,2])->default(1);  //1: borrador 2:publicado
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('emails');
    }
};
