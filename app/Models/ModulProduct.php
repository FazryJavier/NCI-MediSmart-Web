<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulProduct extends Model
{
    use HasFactory;
    protected $table='modul_products';
    protected $guarded=[];

    public function products()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
