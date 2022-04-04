<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'personal_info';
    protected $fillable = ['user_id', 'first_name', 'last_name', 'dob', 'phone_number', 'email', 'address', 'department'];

    public function account() {
        return $this->belongsTo(Account::class, 'user_id');
    }
}
