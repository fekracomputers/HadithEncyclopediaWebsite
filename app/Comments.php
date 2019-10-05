<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $connection = 'feed';

    protected $table = 'comments';

}
