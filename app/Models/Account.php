<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'accounts';
    protected $fillable = ['user_name', 'password', 'role'];
    protected $hidden = [
        'password',
    ];

    const ACCOUNT_ADMIN = 'admin';
    const ACCOUNT_STAFF = 'staff';
    const ACCOUNT_QAC = 'QAC';
    const ACCOUNT_QAM = 'QAM';

    public function is_admin()
    {
        return $this->role === self::ACCOUNT_ADMIN;
    }
    public function is_QAM()
    {
        return $this->role === self::ACCOUNT_QAM;
    }
    public function is_QAC()
    {
        return $this->role === self::ACCOUNT_QAC;
    }
    public function is_staff()
    {
        return $this->role === self::ACCOUNT_STAFF;
    }

    public function personal_info()
    {
        return $this->hasOne(Personal::class, 'user_id', 'id');
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class, 'user_id', 'id');
    }

    public function likeDislikes()
    {
        return $this->hasMany(LikeDislike::class, 'user_id');
    }

    public function isLiked(Model $object): bool
    {
        return $this->whereHas('likeDislikes' , function($q) use ($object) {
                $q->where('user_id', Auth::guard('account')->user()->id)
                    ->where('idea_id', $object->id)
                    ->where('type', 1);
            })->get()->count() > 0;
    }

    public function isDisliked(Model $object): bool
    {
        return $this->whereHas('likeDislikes' , function($q) use ($object) {
                $q->where('user_id', Auth::guard('account')->user()->id);
                $q->where('idea_id', $object->id);
                $q->where('type', 0);
            })->get()->count() > 0;
    }

}
