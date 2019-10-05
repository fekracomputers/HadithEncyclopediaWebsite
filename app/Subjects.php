<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $connection = 'hadith';

    protected $table = 'subjects';
}
