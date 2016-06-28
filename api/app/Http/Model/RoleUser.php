<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $connection = 'user';
    protected $table = 'role_user';
    public $timestamps = false;
}
