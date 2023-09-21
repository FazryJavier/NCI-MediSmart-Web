<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageModulProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_modul_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modulId')->constrained('modul_products')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image');
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
        Schema::dropIfExists('image_modul_products');
    }
}
