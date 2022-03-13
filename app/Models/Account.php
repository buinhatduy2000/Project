<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'accounts';
    protected $fillable = ['user_name', 'password', 'role'];
    protected $hidden = [
        'password',
    ];

    const ACCOUNT_ADMIN = 'admin';
    const ACCOUNT_STAFF = 'staff';
    const ACCOUNT_QAC = 'QAC';
    const ACCOUNT_QAM = 'QAM';

    public function personal_info()
    {
        return $this->hasOne(Personal::class, 'user_id', 'id');
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class, 'user_id', 'id');
    }
}
