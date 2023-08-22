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
        Schema::create('variables', function (Blueprint $table) {
            $table->id();
            $table->longText('name')->nullable();
            $table->enum('status',[1,2])->default(1); //1 No publicado //2 publicado
            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('graphictype_id')->nullable()->default(1);
            $table->unsignedBigInteger('variabletype_id')->nullable();
            $table->foreign('graphictype_id')
                ->references('id')
                ->on('graphictypes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                $table->foreign('variabletype_id')
                ->references('id')
                ->on('variabletypes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variables');
    }
};


