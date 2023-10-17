<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparasi extends Model
{
    use HasFactory;
    protected $table='sparasis';
    protected $guarded=[];

    public function products()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
