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
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->longText('value')->nullable();
            $table->unsignedBigInteger('variable_id');
            $table->unsignedBigInteger('register_id');

            $table->foreign('variable_id')
                ->references('id')
                ->on('variables')
                ->onDelete('cascade')
                ->onUpdate(' cascade');
            $table->foreign('register_id')
                ->references('id')
                ->on('registers')
                ->onDelete('cascade')
                ->onUpdate(' cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
};
