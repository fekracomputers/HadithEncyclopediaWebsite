<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Narrators extends Model
{
    protected $connection = 'hadith';

    protected $table = 'narrators';

}
