<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SysUser extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
    ];
    //
}
