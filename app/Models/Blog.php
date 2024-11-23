<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'content',
        'image',
        'start_at',
        'end_at',
        'blogcate_id',
        'poster_id',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blogcate_id', 'id');
    }

    public function poster()
    {
        return $this->belongsTo(User::class, 'poster_id', 'id');
    }

    
}
