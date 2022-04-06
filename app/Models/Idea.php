<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

class Idea extends Model
{
    use HasFactory, Likeable;
    protected $table = 'ideas';
    protected $fillable = ['idea_title', 'user_id', 'category_id', 'description', 'views', 'department'];

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Account::class, 'user_id');
    }

    public function documents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Document::class, 'idea_id', 'id');
    }
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'idea_id', 'id');
    }
    public function latestComment()
    {
        return $this->hasOne(Comment::class, 'idea_id')->latest('id');
    }
}
