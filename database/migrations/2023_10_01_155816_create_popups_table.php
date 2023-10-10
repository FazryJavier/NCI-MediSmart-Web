<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1)->nullable(); // Kolom boolean untuk status popup (default: 1)
            $table->dateTime('start_date')->nullable(); // Kolom tanggal dan waktu awal (nullable)
            $table->dateTime('end_date')->nullable(); // Kolom tanggal dan waktu akhir (nullable)
            $table->string('link')->nullable();
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popups');
    }
};
