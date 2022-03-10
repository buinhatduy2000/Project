<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $table = 'personal_info';
    protected $fillable = ['user_id', 'first_name', 'last_name', 'dob', 'phone_number', 'email', 'address', 'department'];

    public function acccount() {
        return $this->belongsTo(Account::class, 'user_id');
    }
}
