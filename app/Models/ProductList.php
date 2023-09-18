<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;
    protected $table='product_lists';
    protected $guarded=[];

    public function products()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
