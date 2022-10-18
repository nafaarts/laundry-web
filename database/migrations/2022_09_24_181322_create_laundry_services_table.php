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
        Schema::create('laundry_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laundry_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->binary('icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laundry_services');
    }
};
