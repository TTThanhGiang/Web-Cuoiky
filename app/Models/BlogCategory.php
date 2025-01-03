<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table = 'blogcategories';
    protected $fillable = [
        'id',
        'name',
    ];

    protected $dates = ['deleted_at'];

    public function Blogs()
    {
        return $this->hasMany(Blog::class);
    }
}