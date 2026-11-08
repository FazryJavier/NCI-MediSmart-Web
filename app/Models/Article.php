<?php

namespace App\Models;

use App\Models\Concerns\HasPublicUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasPublicUrl;
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

    protected function publicRouteName(): string
    {
        return 'blog.show';
    }
}
