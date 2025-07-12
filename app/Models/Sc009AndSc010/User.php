<?php

namespace App\Models\Sc009AndSc010;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'username';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password_hash',
        'role_id',
        'is_deleted',
        'fullname',
        'avatar_url',
    ];
}
