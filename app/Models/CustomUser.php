<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomUser extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;
    protected $table = 'custom_users';
    protected $fillable = [
        'fullname', 'usename', 'email', 'phone',
        'address', 'birthday', 'gender', 'avt',
        'password', 'email_verified_at', 'role'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function cast(): array{
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
