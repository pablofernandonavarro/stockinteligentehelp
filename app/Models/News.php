<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;
    protected $table = 'news';
    protected $fillable = ['title', 'slug', 'content', 'image', 'published_at', 'author_id', 'is_featured', 'category_id', 'status'];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
{
    return $this->belongsTo(User::class, 'author_id');
}

}
