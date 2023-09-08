<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvantageModulProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advantage_modul_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modulId')->constrained('modul_products')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('icon');
            $table->text('description');
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
        Schema::dropIfExists('advantage_modul_products');
    }
}
