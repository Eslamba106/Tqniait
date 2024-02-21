<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'created_at', 'updated_at' ];

    protected $table = 'tags';

    public function posts()
    {
        return $this->belongsToMany(Post::class , 'tags_posts_pivot');
    }
}
