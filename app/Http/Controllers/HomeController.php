<?php

namespace App\Http\Controllers;

use App\Narrators;
use Carbon\Carbon;
use EllisTheDev\Robots\Robots;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
use App\Authors ;
use App\Category ;
use App\Books ;
use App\BooksAuthor ;
use App\Subjects ;
use App\NarratorsHadith ;
use App\Hadith ;
use App\HadithBody ;
use App\Feedback ;
use App\NarratorsAdala ;
use App\NarrtorsFTS ;
use Illuminate\Support\Facades\Cookie ;
use Illuminate\Pagination\Paginator ;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App ;
use App\Comments ;
use App\HadithFts ;
use App\Mail\VerifyMail ;
use App\Mail\ConfirmationMail ;
use Illuminate\Support\Facades\Mail;
use Illuminate\Session ;

class HomeController extends Controller
{
    /*
     * Home Page
     * return author , category , books
     * view index
     * */

    public function index(){
        /*get author limited 9*/
        $author = Authors::all()->take(9);

        /*get category limited 9*/
        $category = Category::all()->take(9);

        /*get books with authors*/
        $book = DB::connection('hadith')->select('select * from booksauthors
              JOIN books ON books.id = booksauthors.bookid
              JOIN authors ON authors.id = booksauthors.authorid Limit 9');

        /*number of authors and topic and books and hadith and narrators*/
        $num_author = Authors::count();
        $num_book = Books::count();
        $num_Hadith = Hadith::count();
        $num_topic = Category::count();
        $num_subject = Subjects::count();
        $num_narrators = Narrators::count();
        return view('home.index', compact('author','category','book',
                    'num_author','num_book','num_Hadith','num_topic','num_narrators','num_subject'));
    }

    /*
     * Topic Page
     * Return Categories with load more
     * */

    public function AllTopic(){
        $category = Category::all()->take(12);
        $title = 'الموضوعات' ;
        return view('home.topic', compact('category','title'));

    }

    /*
     * Single topic
     * return books for this topic
    */
    public function singleTopic($_id , $slug ,Request $request){
        $catid = (int)$_id ;
        $book = DB::connection('hadith')->select('select * from booksauthors
              JOIN books ON books.id = booksauthors.bookid
              JOIN authors ON authors.id = booksauthors.authorid 
              WHERE books.categoryid ='.$catid .'');

        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($book);

        //Define how many items we want to be visible in each page
        $perPage = 9;

        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice(($currentPage-1) * $perPage, $perPage)->all();

        //Create our paginator and pass it to the view

        $book = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $book->setPath('topic/'.$_id.'/'.$slug);
        $title = 'الموضوعات' ;
        if($request->ajax()){
            return view('home.loadbook',compact('book','title','catid'));
        }
        return view('home.single-topic', compact('book','title','catid'));

    }

    /*
     * Single book
     * return book information
    */
    public function singleBook($_id , $slug){
        $id = (int)$_id ;
        $connection = DB::connection('hadith');
        $subject = collect($connection->select('select * from subjects WHERE bookid ='.$id.'
                    and parentid = 0 limit 9'));
            $result = $subject ;
            $c_sub = Subjects::select()->where(['bookid'=>$id ,'parentid'=>0])->count();
            if(count($subject) == 1){
                $subtitle = $connection->select('select * from subjects WHERE bookid ='.$id.'
                    and parentid ='.$subject[0]->id.'');
            }else{
                $subtitle ='';
            }
            $book = $connection->select('select * from booksauthors
              JOIN books ON books.id = booksauthors.bookid
              JOIN authors ON authors.id = booksauthors.authorid 
              WHERE booksauthors.bookid ='.$id);
            $hadith = get_hadith($id);
            $subMore = Hadith::select()->where(['bookid'=> $id , 'id'=>$hadith])->first();
            if ($subMore ==''){
                $subMore = 0 ;
            }else{
                $subMore = $subMore->subjectid ;
            }
            $counter = round($c_sub / 9) ;

            return view('home.singlebook', compact('result','subject','book','subtitle','hadith','subMore','counter'));



    }
 /*
     * Single book
     * return book information
    */
    public function getTefsser($bookid , $hadithid){
        $bookid = (int)$bookid ;
        $hadithid = (int)$hadithid ;
        $hadith = json_decode(file_get_contents('http://booksapi.islam-db.com/api/getpage/'.$bookid.'/'.$hadithid.''), true);
        $book = json_decode(file_get_contents('http://booksapi.islam-db.com/api/getbook/'.$bookid.''), true);
        return view('home.tefseer',compact('hadith','book','bookid','hadithid')) ;
    }
    public function getTefsserContain($bookid , $hadithid){
        $bookid = (int)$bookid ;
        $hadithid = (int)$hadithid ;
        $hadith = json_decode(file_get_contents('http://booksapi.islam-db.com/api/getpage/'.$bookid.'/'.$hadithid.''), true);
        $book = json_decode(file_get_contents('http://booksapi.islam-db.com/api/getbook/'.$bookid.''), true);
        return view('home.tefseer-contain',compact('hadith','book','bookid','hadithid')) ;
    }

    /*
     * all books
     * return all book limit 12
    */
    public function allBooks(){
        $connection = DB::connection('hadith');
        $book = $connection->select('select * from booksauthors
              JOIN books ON books.id = booksauthors.bookid
              JOIN authors ON authors.id = booksauthors.authorid 
              limit 9');

        return view('home.all-book', compact('book'));

    }

    /*
     * load more topic
     * return more categories
     * */
    public function loadTopic(Request $request){
        if($request->ajax()){
            $id = $request->input('id');
            $category = Category::all()->where('id','>', $id)->take(6);
            return view('home.loadtopic', compact('category'));

        }else{
            abort(404);
        }
    }

    /*
    * load more books
    * return more books
    * */
    public function loadBook(Request $request){
        if($request->ajax()) {
            $id = $request->input('id');
            $catid = $request->input('catid');
            $book = DB::connection('hadith')->select('select * from booksauthors
              JOIN books ON books.id = booksauthors.bookid
              JOIN authors ON authors.id = booksauthors.authorid 
              WHERE books.categoryid =' . $catid . ' AND booksauthors.bookid > ' . $id . ' limit 9');
            return view('home.loadbook', compact('book'));
        }else{
            abort(404);
        }

    } /*

    * load more books
    * return more books
    * */
    public function loadAllBook(Request $request){
        if($request->ajax()){
            $id = $request->input('id');
            $book = DB::connection('hadith')->select('select * from booksauthors
              JOIN books ON books.id = booksauthors.bookid
              JOIN authors ON authors.id = booksauthors.authorid 
              WHERE  booksauthors.bookid > '.$id .' limit 9');
            return view('home.loadbook', compact('book'));
        }else{
            abort(404);
        }

    }


    /*
     * load Title For Single Book
     * return title
     * */
    public function loadTitle(Request $request){
        if($request->ajax()){
            $bookid = strip_tags($request->input('id'));
            $connection = DB::connection('hadith');
            $subject = $connection->select('select * from subjects WHERE bookid ='.$bookid.'
                    and parentid = 0 ');
    //Get current page form url e.g. &page=6
            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            //Create a new Laravel collection from the array data
            $collection = new Collection($subject);

            //Define how many items we want to be visible in each page
            $perPage = 9;

            //Slice the collection to get the items to display in current page
            $currentPageSearchResults = $collection->slice(($currentPage-1) * $perPage, $perPage)->all();

            //Create our paginator and pass it to the view

            $result = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
            $result->setPath('loadtitle');
            $book = Books::findOrfail($bookid);
            return view('home.loadtitle', compact('result','subject','book'));
        }else{
            abort(404);
        }

    }

     /*
     * Search Live On Book
     * return Book title
     * */
    public function searchTitle(Request $request){
        if($request->ajax()){
            $id = $request->input('catid');
            $text = removeChar($request->input('text'));
            $subject = DB::connection('hadith')->select('select * from subjects 
              WHERE bookid ='.$id .' And shorttitle like \'%'.$text.'%\'');
            $book = Books::findOrfail($id);
            return view('home.loadtitle', compact('subject','book'));

        }else{
            abort(404);
        }


    }


    /*
     * Search Live On Books
     * return Books
     * */
    public function searchBooks(Request $request){
        $id = $request->input('id');
        $text = searchHadith($request->input('text'));
        $catid =$request->input('catid');
        $book = DB::connection('hadith')->select('select * from booksauthors
              JOIN books ON books.id = booksauthors.bookid
              JOIN authors ON authors.id = booksauthors.authorid 
              WHERE books.categoryid ='.$catid .' And books.searchtext like \'%'.$text.'%\'');
        return view('home.loadbook', compact('book'));

    }


    /*
     * Search Live On All Books
     * return Books
     * */
    public function searchallbooks(Request $request){
        $id = $request->input('id');
        $text = searchHadith($request->input('text'));
        $book = DB::connection('hadith')->select('select * from booksauthors
              JOIN books ON books.id = booksauthors.bookid
              JOIN authors ON authors.id = booksauthors.authorid 
              WHERE books.searchtext like \'%'.$text.'%\' ');
        return view('home.loadbook', compact('book'));

    }


    /*
    * Search Live On topic
    * return categories
    * */
    public function searchTopic(Request $request){
        $text = searchHadith($request->input('text'));
        $category = DB::connection('hadith')->select('select * from categories 
        where searchtext like \'%'.$text.'%\'');
        return view('home.loadtopic', compact('category'));
    }

    /*
     * Authors Page
     * Return Authors with load more
     * */
    public function Authors(){
        $author = Authors::all()->take(12);
        $title = 'المؤلفين' ;
        return view('home.authors', compact('author','title'));

    }

         /*
        * Search Live On Author
        * return Authors
        * */
    public function searchAuthor(Request $request){
        $text = searchHadith($request->input('text'));
        $author = DB::connection('hadith')->select('select * from authors 
        where searchtext like \'%'.$text.'%\'');
        return view('home.loadauthor', compact('author'));
    }

    /*
        * Search Live On Author
        * return Authors
        * */
    public function searchNarrators(Request $request){
        $text = searchHadith($request->input('text'));
        $rotba = searchHadith($request->input('rotba'));
        $result = new Collection();
        if($rotba  && (!empty($text))){
            $narrator = DB::connection('fts')->select('select * from narratorsfts where searchtext MATCH \'%'.$text.'%\' 
                    and rotba LIKE \'%'.$rotba.'%\' limit 12');

        }elseif(!empty($text)){
            $narrator = DB::connection('fts')->select('select * from narratorsfts where searchtext MATCH \'%'.$text.'%\' limit 12');
        }else{
            $narrator = DB::connection('fts')->select('select * from narratorsfts where rotba MATCH \'%'.$rotba.'%\' limit 12');

        }

            foreach ($narrator as $row) {
                $res = Narrators::select()->where('id',$row->id)->first();
                $result->push([
                    'id' => $res->id ,
                    'name' => $res->name ,
                    'gender'    => $res->gender ,
                    'lakab'       => $res->lakab,
                    'rotba'       => $res->rotba,
                    'higribirthyear'       => $res->higribirthyear,
                    'higrideathyear'       => $res->higrideathyear,
                ]);
            }
        $counter = count($result);
        $page =1;
        return view('home.loadsearchnarrators', compact('result','text','rotba','counter','page'));
    }

    /*load Search Narrators*/
    public function LoadSearchNarrator(Request $request){
        $text = searchHadith($request->input('search'));
        $rotba = searchHadith($request->input('rotba'));
        $page = $request->input('page') ;

        $result = new Collection();
        if($rotba  && (!empty($text))){
            $narrator = DB::connection('fts')->select('select * from narratorsfts where searchtext MATCH \'%'.$text.'%\' 
                    and rotba LIKE \'%'.$rotba.'%\'');

        }elseif(!empty($text)){
            $narrator = DB::connection('fts')->select('select * from narratorsfts where searchtext MATCH \'%'.$text.'%\'');
        }else{
            $narrator = DB::connection('fts')->select('select * from narratorsfts where rotba MATCH \'%'.$rotba.'%\'');

        }

        foreach ($narrator as $row) {
            $res = Narrators::select()->where('id',$row->id)->first();
            $result->push([
                'id' => $res->id ,
                'name' => $res->name ,
                'gender'    => $res->gender ,
                'lakab'       => $res->lakab,
                'rotba'       => $res->rotba,
                'higribirthyear'       => $res->higribirthyear,
                'higrideathyear'       => $res->higrideathyear,
            ]);
        }

        //Get current page form url e.g. &page=6
        if($request->ajax()){
            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            //Create a new Laravel collection from the array data
            $collection = new Collection($result);

            //Define how many items we want to be visible in each page
            $perPage = 12;

            //Slice the collection to get the items to display in current page
            $currentPageSearchResults = $collection->slice(($currentPage-1) * $perPage, $perPage)->all();

            //Create our paginator and pass it to the view

            $result = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
            $result->setPath('loadsearchnarrators?search='.$text.'&rotba='.$rotba);
            $counter = round(count($collection)/12);

            return view('home.loadsearchnarrators', compact('result','text','rotba','counter','page'));
        }

    }

    /*
     * Single Author Page
     * return author information
     * */
    public function singleAuthor($_id , $name){
        $id = (int)$_id;
        $connection = DB::connection('hadith') ;
        $author = $connection->select('select * from authors WHERE id ='.$id.'');
        $book = $connection->select('select * from booksauthors
              JOIN books ON books.id = booksauthors.bookid
              JOIN authors ON authors.id = booksauthors.authorid 
              WHERE authors.id ='.$id .'');
        return view('home.single-author',compact('book','author'));

    }

    /*
    * load more author
    * return more authors
    * */
    public function loadAuthors(Request $request){
        $id = $request->input('id');
        $author = Authors::all()->where('id','>', $id)->take(9);
        return view('home.loadauthor', compact('author'));
    }

    /*
     * load Narrators
     * return Narrators
     * */
    public function allNarrators(){
        $connection = DB::connection('hadith') ;
        $result = collect($connection->select('select * from narrators WHERE id != 0 limit 12'));
        $title = "الرواة" ;
            return view('home.allnarrators',compact('result','title'));

    }

    public function loadNarrators(Request $request){
            $id = $request->input('id');
            $connection = DB::connection('hadith') ;
            $result = collect($connection->select('select * from narrators WHERE id > '.$id.' limit 12'));
            return view('home.loadnarrators',compact('result'));
    }
    /*
     * load child title
     * return child title
     * */

    public function narratorHadith($_id,$slug , Request $request){
        $id = (int)$_id;
        $narrator = NarratorsHadith::select('bookid','hadithid')->where('narratorid',$id)->take(12)->get();
        $info = Narrators::select()->where('id',$id)->first();
        $res = new Collection();
        $fts = DB::connection('fts');
        foreach ($narrator as $row) {
            $hadith = collect($fts->select('select c2searchbody from hadithfts_content
          WHERE c1hadithid ='.$row->hadithid.' and c0bookid ='.$row->bookid.' '));

            $title = Books::select('title','id')->where('id',$row->bookid)->first();
            $subjectid = Hadith::select('subjectid')
                ->where(['bookid'=>$row->bookid ,'id'=>$row->hadithid])
                ->first();
            if($subjectid->subjectid == ''){
                $subid = 0 ;
            }else{
                $subid =$subjectid->subjectid ;
            }

            $res->push([
                'subid' => $subid ,
                'hadithid' => $row->hadithid ,
                'bookid'    => $title->id ,
                'title'         => $title->title,
                'content'       => str_limit($hadith[0]->c2searchbody,'150'),
            ]);
        }
        $counter = count($res);

        return view('home.narrator-hadith' , compact('res','counter','info')) ;
    }
    public function loadNarratorHadith($_id,Request $request){
        $id = (int)$_id;
        $narrator = NarratorsHadith::select('bookid','hadithid')->where('narratorid',$id)->get();
        $info = Narrators::select()->where('id',$id)->first();
        $res = new Collection();
        $fts = DB::connection('fts');
        foreach ($narrator as $row) {
            $hadith = collect($fts->select('select c2searchbody from hadithfts_content
          WHERE c1hadithid ='.$row->hadithid.' and c0bookid ='.$row->bookid.' '));

            $title = Books::select('title','id')->where('id',$row->bookid)->first();
            $subjectid = Hadith::select('subjectid')
                ->where(['bookid'=>$row->bookid ,'id'=>$row->hadithid])
                ->first();
            if($subjectid->subjectid == ''){
                $subid = 0 ;
            }else{
                $subid =$subjectid->subjectid ;
            }

            $res->push([
                'subid' => $subid ,
                'hadithid' => $row->hadithid ,
                'bookid'    => $title->id ,
                'title'         => $title->title,
                'content'       => str_limit($hadith[0]->c2searchbody,'150'),
            ]);
        }
        //Get current page form url e.g. &page=6
        if($request->ajax()){

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($res);

        //Define how many items we want to be visible in each page
        $perPage = 12;

        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice(($currentPage-1) * $perPage, $perPage)->all();

        //Create our paginator and pass it to the view

        $res = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $res->setPath('loadnarrators-hadith/'.$id.'/');
        $counter = round(count($collection) / 9);
            return view('home.loadhadith',compact('res'));
        }

    }

    public function loadSubTitle(Request $request){
        $id = $request->input('id');
        $bookid = $request->input('catid');
        $book = Books::find($bookid);

        $connection = DB::connection('hadith');
        $subject = $connection->select('select * from subjects WHERE bookid ='.$bookid.'
                    and parentid ='.$id);
        return view('home.subtitle',compact('subject','book'));

    }

    /*
     * load My Books saved in cookies
     * return books
     * */
    public function myBooks(){
        $books = Cookie::get('books');
        $book = [];
        if($books){

//            $id = implode(',',$books);
            foreach ($books as $id ){
                $all = DB::connection('hadith')->select('select * from booksauthors
              JOIN books ON books.id = booksauthors.bookid
              JOIN authors ON authors.id = booksauthors.authorid 
              WHERE booksauthors.bookid IN'.'('.$id .')'.'');
                array_push($book , $all);
            }
            $book =  array_collapse($book) ;
        }else{
            $book = [];
        }
        $title = "كتبي" ;


        return view('home.mybook',compact('book','title')) ;
    }

    /*
     * delete cookies
     * delete book id from cookies
     * */
    public function deleteCookie(Request $request){
        $id = $request->input('id');
        delete_cookie($id) ;
        $books = Cookie::get('books');

    }
    /*
     * main search for hadith
     * return hadith
     * */
    public function Search(Request $request){
        $text = searchHadith($request->input('search'));
        $fts = DB::connection('fts');
        $hadith = DB::connection('hadith');
        $result = collect($fts->select('select hadithid,searchbody,bookid from hadithfts WHERE searchbody MATCH \'%'.$text.'%\' '));
        $alldata = new Collection();
        foreach ($result as $row) {
            $title = Books::select('title','id')->where('id',$row->bookid)->first();

            $subjectid = Hadith::select('subjectid')
                ->where(['bookid'=>$row->bookid ,'id'=>$row->hadithid])
                ->first();
            if($subjectid->subjectid == ''){
                $subid = 0 ;
            }else{
                $subid =$subjectid->subjectid ;
            }

            $alldata->push([
                'subid' => $subid ,
                'hadithid' => $row->hadithid ,
                'bookid'    => $title->id ,
                'title'         => $title->title,
                'content'       => str_limit($row->searchbody,'100'),
            ]);
        }
        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($alldata);

        //Define how many items we want to be visible in each page
        $perPage = 10;

        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice(($currentPage-1) * $perPage, $perPage)->all();

        //Create our paginator and pass it to the view

        $final = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $final->setPath('search-hadith?search='.$text);
        if($request->ajax()){
            return view('home.loadsearch',compact('text','final'));
        }
        return view('home.search-result' , compact('text','final')) ;

    }


    /*
     * load search word
     * return search word from fts to auto complete
     * */
    public function searchItem(Request $request){
            $text = searchHadith($request->input('term'));
            $fts = DB::connection('fts');
            $result = $fts->select('select * from words where word like \'%'.$text.'%\' 
              ORDER BY frequency desc  limit 20');
            return response()->json($result) ;

    }

    /*
     * books contain
     * return hadith and subject and narrators
     * */
    public function singlePage($id ,$slug ,$subject,$hid = null){
        $bookid = (int)$id;
        set_cookie($bookid);
        if($hid !=null){
        $hd = (int)$hid ;
            if($subject == 0){
                $sub = Hadith::select()->where(['bookid' => $bookid ,'id'=>$hd])->first();
                $subjects = Subjects::find($sub->subjectid);
                $subjectid = $sub->subjectid ;
                if(!$subjects){
                    $subjects ='';
                    $subjectid = 0 ;
                }
            }else{
                $subjectid = (int)$subject ;
                $subjects = Subjects::find($subjectid);
            }

        }else{

                $subjectid = (int)$subject ;
                $subjects = Subjects::find($subjectid);
                if($subjects->parentid == 0) {
                    $hd = $subjects->firsthadithid ;
                }else{
                    $hadithid = Hadith::select('id')->where('bookid',$bookid)
                        ->where('subjectid',$subjectid)->first();
                    $hd = $hadithid->id ;
                }
        }

            $hadith = HadithBody::select()->where(['id'=>$hd , 'bookid'=>$bookid])->first();
            $first = Hadith::select()->where('bookid',$bookid)->first();
            $first_subject = Hadith::select()->where(['bookid'=>$first->bookid ,'id'=>$first->id])->first() ;
            $last = Hadith::select()->where('bookid',$bookid)->orderby('id','desc')->first();
            $last_subject = Hadith::select()->where(['bookid'=>$last->bookid ,'id'=>$last->id])->first() ;

        $dbcon = DB::connection('hadith');
            $narrators =$dbcon->select('select * from hadithnarrators 
                        JOIN narrators ON hadithnarrators.narratorid = narrators.id
                        WHERE hadithnarrators.hadithid ='.$hd.'
                        and hadithnarrators.bookid='.$bookid.' order by hadithnarrators.narratororder DESC');
        set_hadith($id ,$hd);
            $book = Books::findOrfail($bookid);
        return view('home.hadith',compact('last_subject','first_subject','last','first','hadith','subjects','num','subjectid','bookid','narrators','book'));
    }


    /*
     * books contain
     * return hadith and subject and narratrs
     * */
    public function loadHadith(Request $request){
        $bookid = (int)$request->input('bookid');
        $hd = (int)$request->input('id');
        $subjectid = $request->input('subjectid');
        if($hd !=null){
            $hd = (int)$hd ;
            if($subjectid == 0){
                $sub = Hadith::select()->where(['bookid' => $bookid ,'id'=>$hd])->first();
                $subjects = Subjects::find($sub->subjectid);
                $subjectid = $sub->subjectid ;
                if(!$subjects){
                    $subjects ='';
                    $subjectid = 0 ;
                }
            }else{
                $subjectid = (int)$subjectid ;
                $subjects = Subjects::find($subjectid);
            }

        }else{

            $subjects = Subjects::find($subjectid);
            if($subjects->parentid == 0) {
                $hd = $subjects->firsthadithid ;
            }else{
                $hadithid = Hadith::select('id')->where('bookid',$bookid)
                    ->where('subjectid',$subjectid)->first();
                $hd = $hadithid->id ;
            }
        }

        $hadith = HadithBody::select()->where(['id'=>$hd , 'bookid'=>$bookid])->first();
        $first = Hadith::select()->where('bookid',$bookid)->first();
        $first_subject = Hadith::select()->where(['bookid'=>$first->bookid ,'id'=>$first->id])->first() ;
        $last = Hadith::select()->where('bookid',$bookid)->orderby('id','desc')->first();
        $last_subject = Hadith::select()->where(['bookid'=>$last->bookid ,'id'=>$last->id])->first() ;
        $dbcon = DB::connection('hadith');

        $narrators =$dbcon->select('select * from hadithnarrators 
                        JOIN narrators ON hadithnarrators.narratorid = narrators.id
                        WHERE hadithnarrators.hadithid ='.$hd.'
                        and hadithnarrators.bookid='.$bookid.' order by hadithnarrators.narratororder DESC');


        $book = Books::findOrfail($bookid);
        set_hadith($bookid ,$hd);

        return view('home.hadithcontent',compact('last_subject','first_subject','last','first','hadith','subjects','num','subjectid','bookid','narrators','book'));

    }

    /*
     * narrators informatin
     * return narrators data
     *  */

    public function narrators($id ,$name){
        $_id = (int)$id ;
        $narrator = Narrators::findOrfail($_id);
        $student = DB::connection('hadith')->select('
            select * from narratorsstudents
            JOIN narrators ON narrators.id = narratorsstudents.studentid
            WHERE narratorsstudents.narratorid = '.$_id.'');
        $teacher = DB::connection('hadith')->select('
              select * from narratorsteachers
              JOIN narrators ON narrators.id = narratorsteachers.teacherid
              WHERE narratorsteachers.narratorid = '.$_id.'');
        $jerh = NarratorsAdala::select()->where('id',$_id)->get();
        return view('home.narrators',compact('narrator','student','teacher','jerh'));
    }

    /*
     * About Us Page
     * return information about fekra company
     * */
    public function about(){
        $title = 'عن الموقع' ;
        return view('home.about',compact('title'));
    }
    /*
     * Comment Page
     * show view of comment
     * */
    public function comment(Request $request){
        $url = strip_tags(removeSql($request->input('url')));
        $type = removeSql($request->input('type'));
        $label = removeSql($request->input('label'));
        return view('home.comment',compact('url','type','label'));
    }
    /*
     * Add comment
     * save the comment with information
     * */
    public function addcomment(Request $request){
        $url = removeSql(trim($request->input('url')));
        $label = removeSql(trim($request->input('label')));
        $email = trim(removeSql($request->input('email')));
        $comment = trim(removeSql(nl2br($request->input('comment'))));
        $type = trim(removeSql($request->input('type')));
        $random =  str_random(20);
        $conn = DB::connection('feed');
        $ver = Comments::where(['email'=>$email])->orderby('id','desc')->get();

        if($ver){
            foreach($ver as $row){
                if ($row['status'] == 'verified' ){
                    $status = 'verified' ;
                    break ;
                }elseif ($row['status'] == 'Resolve'){
                    $status = 'verified' ;
                    break ;
                }else{
                    $status = 'New' ;
                    break ;
                }
            }
        }else{
            $status = 'New' ;
        }
        if(!isset($status)){
            $status = 'New';
        }
        $conn->table('comments')->insert([
            ['email' => $email,'comment'=>$comment ,
            'type' => $type , 'url'=> $url,
            'status' => $status,'label'=> $label,'token'=>$random,
            'created_at'=> Carbon::now()]
        ]);

        $subject = $type .'  -  '. $label ;
        if($status == 'New'){
            Mail::to($email)->send(new VerifyMail($random));
        }if($status == 'verified'){
            Mail::to($email)->send(new ConfirmationMail($subject));
        }
        $request->session()->flash('status', 'تم إضافة تعليقك');
        return redirect()->back();
    }
    public function emailVerify(Request $request){
        $code = $request->input('acc');
        $comment = Comments::select()->where('token',$code)->first();
        $conn = DB::connection('feed');
        if($comment){
            if($comment->status == "New"){
                $conn->
                table('comments')
                    ->where('id', $comment->id)
                    ->update(['status' => 'verified']);
                $message = 'تم تفعيل البريد الالكتروني الخاص بك , شكرا';
                $color = '#118832';
                $subject = $comment->type .' - '. $comment->label ;
                Mail::to($comment->email)->send(new ConfirmationMail($subject));
                $allMail = Comments::select()->where(['email'=>$comment->email,'status'=>'New'])->get();
                if($allMail){
                    foreach ($allMail as $row){
                        $conn->
                        table('comments')
                            ->where('id', $row->id)
                            ->update(['status' => 'verified']);
                        $message = 'تم تفعيل البريد الالكتروني الخاص بك , شكرا';
                        $color = '#118832';
                        $subject = $row->type .' - '. $row->label ;
                        Mail::to($row->email)->send(new ConfirmationMail($subject));

                    }
                }
            }

        }else{
            $message =  'لم يتم تفعيل البريد الألكتروني الخاص بك , برجاء إعادة المحاولة';
            $color = '#3C7678';
        }
        return view('home.verify',compact('message','color'));
    }
    /*
     * SiteMap Function
     * genrate Sitemap
     * */
    public function sitemap()
    {

        // create sitemap
        $sitemap_books = App::make("sitemap");

        // add items
        $books = Books::select()->orderby('id')->get();
        foreach ($books as $row)
        {
            $sitemap_books->add('http://hadith.islam-db.com/books/'.$row->id.'/'.slug_title($row->title), Carbon::now(),'1.0' ,'monthly');
        }

        // create file sitemap-books.xml in your public folder (format, filename)
        $sitemap_books->store('xml','sitemaps/sitemap-0');



        // create sitemap
        $sitemap_categories = App::make("sitemap");

        // add items
        $category = Category::select()->orderby('id')->get();
        foreach ($category as $row)
        {
            $sitemap_categories->add('http://hadith.islam-db.com/topic/'.$row->id.'/'.slug_title($row->title), Carbon::now(),'1.0' ,'monthly');

        }

        // create file sitemap-categories.xml in your public folder (format, filename)
        $sitemap_categories->store('xml','sitemaps/sitemap-1');


        // create sitemap
        $sitemap_author = App::make("sitemap");

        // add items
        $authors = Authors::select()->orderby('id')->get();
        foreach ($authors as $row)
        {
            $sitemap_author->add('http://hadith.islam-db.com/single-authors/'.$row->id.'/'.slug_title($row->name), Carbon::now(),'1.0' ,'monthly');
        }

        // create file sitemap-authors.xml in your public folder (format, filename)
        $sitemap_author->store('xml','sitemaps/sitemap-2');



        // create sitemap
        $sitemap_narrators = App::make("sitemap");

        // add items
        $narrators = Narrators::select()->orderby('id')->get();
        foreach ($narrators as $row)
        {
            $sitemap_narrators->add('http://hadith.islam-db.com/narrators/'.$row->id.'/'.slug_title($row->name), Carbon::now(),'1.0' ,'monthly');
        }

        // create file sitemap-narrators.xml in your public folder (format, filename)
        $sitemap_narrators->store('xml','sitemaps/sitemap-3');

        // create sitemap
        $sitemap_hadith = App::make("sitemap");

        // add items
        $book = Books::select()->orderby('id')->get();
        $counter = 4 ;
        // create sitemap index
        $sitemap = App::make ("sitemap");

        foreach ($book as $row)
        {
            $hadith = Hadith::select()->where('bookid',$row->id)->orderby('id')->get();

            if($hadith){
                foreach ($hadith as $value){
                    if($value->subjectid == ''){
                        $subject = 0 ;
                    }else{
                        $subject = $value->subjectid ;
                    }
                    $sitemap_hadith->add('http://hadith.islam-db.com/single-book/'.$row->id.'/'.slug_title($row->title).'/'.$subject.'/'.$value->id, Carbon::now(),'1.0' ,'monthly');
                }
                $sitemap_hadith->store('xml','sitemaps/sitemap-'.$counter);
                $sitemap->addSitemap('http://hadith.islam-db.com/sitemaps/sitemap-'.$counter.'.xml');

                $sitemap_hadith->model->resetItems();
                $counter++ ;
            }

        }



        // add sitemaps (loc, lastmod (optional))
        $sitemap->addSitemap('http://hadith.islam-db.com/sitemaps/sitemap-0.xml');
        $sitemap->addSitemap('http://hadith.islam-db.com/sitemaps/sitemap-1.xml');
        $sitemap->addSitemap('http://hadith.islam-db.com/sitemaps/sitemap-2.xml');
        $sitemap->addSitemap('http://hadith.islam-db.com/sitemaps/sitemap-3.xml');

        if (!empty($sitemap->model->getItems()))
        {
            // generate sitemap with last items
            $sitemap->store('xml','sitemaps/sitemap-'.$counter);
            // add sitemap to sitemaps array
            $sitemap->addSitemap(secure_url('sitemap-'.$counter.'.xml'));
            // reset items array
            $sitemap->model->resetItems();
        }
        // create file sitemap.xml in your public folder (format, filename)
        $sitemap->store('sitemapindex','sitemaps/sitemap');
    }
    public function robot(){

            Robots::addUserAgent('*');
            Robots::addSitemap('sitemaps/sitemap.xml');
            Robots::addAllow('/','Allow');


        return Response::make(Robots::generate(), 200, array('Content-Type' => 'text/plain'));
    }
}

/*load helper function*/
require app_path().'/helpers.php';