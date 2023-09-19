<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $guarded = [];

    public function Users()
    {
        return $this->belongsTo(User::class, 'adminId');
    }
    // public function Article()
    // {
    //     return $this->(User::class, 'adminId')->cascadeDeletes();
    // }
}
