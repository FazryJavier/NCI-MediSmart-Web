<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FacilitiesModulProduct extends Model
{
    use HasFactory;
    protected $table='fasilities_modul_products';
    protected $guarded=[];

    public function modulProducts()
    {
        return $this->belongsTo(ModulProduct::class, 'modulId');
    }
}
