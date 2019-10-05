<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HadithFts extends Model
{
    protected $connection = 'fts';

    protected $table = 'hadithfts_content';

}
