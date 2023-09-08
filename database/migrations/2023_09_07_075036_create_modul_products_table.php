<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modul_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productId')->constrained('products')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('subTitle');
            $table->text('description');
            $table->string('image_main');
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
        Schema::dropIfExists('modul_products');
    }
}
