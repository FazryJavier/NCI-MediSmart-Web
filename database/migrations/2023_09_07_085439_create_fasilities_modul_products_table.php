<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitiesModulProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilities_modul_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modulId')->constrained('modul_products')->onDelete('cascade')->onUpdate('cascade');
            $table->string('description');
            $table->integer('list');
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
        Schema::dropIfExists('fasilities_modul_products');
    }
}
