<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $connection = 'feed';

    protected $table = 'feedback';

    public function comment(){
        return $this->belongsTo('App\Comments');
    }
}
