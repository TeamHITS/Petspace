<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{

    protected $connection = 'mysql2';

    protected $table = 'templates';
}
