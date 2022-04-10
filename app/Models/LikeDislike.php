<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    use HasFactory;
    protected $table = 'like_dislike';
    protected $fillable = ['user_id', 'idea_id', 'type'];

    public function ideas()
    {
        $this->belongsTo(Idea::class, 'idea_id');
    }

    public function users()
    {
        $this->belongsTo(Account::class, 'user_id');
    }
}
