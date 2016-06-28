<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $connection = 'user';
    protected $table = 'modules';
    public $timestamps = false;

}
