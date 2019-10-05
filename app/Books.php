<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $connection = 'hadith';

    protected $table = 'books';
}
