<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class HowItWork extends Model
{
	protected $connection = 'mysql2';
    //use HasFactory;

    protected $table = 'how_it_works';

    public function setSlugAttribute ($value)
    {
        $this->attributes["slug"] = Str::slug($value);
    }
}
