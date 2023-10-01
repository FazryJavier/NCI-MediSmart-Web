<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;

    public function up()
{
    Schema::create('popups', function (Blueprint $table) {
        $table->id();
        $table->string('gambar');
        $table->boolean('hide')->default(false);
        $table->timestamp('waktu_tayang');
        $table->timestamps();
    });
}
}
