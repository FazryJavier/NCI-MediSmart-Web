<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllClient extends Model
{
    use HasFactory;
    protected $table='all_clients';
    protected $guarded=[];
}
