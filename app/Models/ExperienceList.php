<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceList extends Model
{
    use HasFactory;
    protected $table='experiences_lists';
    protected $guarded=[];
}
