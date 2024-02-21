<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['id', 'user_id', 'title', 'body', 'image', 'pinned', 'parent_id', 'created_at', 'updated_at'];

    protected $table = 'posts';

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
