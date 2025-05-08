<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_firstname',
        'user_lastname',
        'user_password',
        'user_role',
        'is_active',
        'date_created',
        'last_login'
    ];

    protected $hidden = [
        'user_password'
    ];

    protected $casts = [
        'date_created' => 'datetime',
        'last_login' => 'datetime'
    ];

    public function getAuthPassword(){
        return $this->user_password;
    }
}
