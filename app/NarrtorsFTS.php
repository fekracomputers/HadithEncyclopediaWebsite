<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NarrtorsFTS extends Model
{
    protected $connection = 'fts';

    protected $table = 'narratorsfts';

}
