<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'pass_class',
        'pass_date',
        'test_style',
        'study_period',
        'study_method',
        'books_used',
        'advice',
        'free_column',
    ];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
