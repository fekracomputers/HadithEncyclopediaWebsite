<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB ;

class BooksAuthor extends Model
{
    protected $connection = 'hadith';

    protected $table = 'booksauthors';

    public function books(){
        DB::connection('hadith')->select('select * from booksauthors
              JOIN books ON books.id = booksauthors.bookid
              JOIN authors ON authors.id = booksauthors.authorid');

    }


}
