<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class FAQ extends Model
{

    protected $connection = 'mysql2';

    protected $table = 'faqs';

    public function setSlugAttribute ($value)
    {
        $this->attributes["slug"] = Str::slug($value);
    }
}
