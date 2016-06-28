<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $connection = 'user';
    protected $table = 'role';
    public $timestamps = false;
}
