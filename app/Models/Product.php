<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $guarded=[];

    public function detailProducts()
    {
        return $this->hasMany(DetailProduct::class, 'productId')->cascadeDeletes();
    }

    public function clientProducts()
    {
        return $this->hasMany(ClientProduct::class, 'productId')->cascadeDeletes();
    }

    public function advantageProducts()
    {
        return $this->hasMany(AdvantageProduct::class, 'productId')->cascadeDeletes();
    }

    public function modulProducts()
    {
        return $this->hasMany(ModulProduct::class, 'productId')->cascadeDeletes();
    }
}
