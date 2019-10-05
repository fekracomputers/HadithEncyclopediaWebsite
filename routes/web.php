<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*sitemap*/
Route::get('sitemap','HomeController@sitemap' );
Route::get('robots.txt','HomeController@robot' );

Route::get('/', 'HomeController@index'); //homepage
Route::get('/topic', 'HomeController@AllTopic'); // categories page (topic)
Route::get('/mybooks', 'HomeController@myBooks'); // categories page (topic)
Route::get('/topic/{id}/{slug}', 'HomeController@singleTopic'); // single category books page (topic)
Route::get('/all-books','HomeController@allBooks');
Route::get('/books/{id}/{slug}', 'HomeController@singleBook'); // single book page
Route::get('/authors', 'HomeController@Authors'); // Authors page
Route::get('/single-authors/{id}/{name}', 'HomeController@singleAuthor'); // Single Author page
Route::get('/all-narrators', 'HomeController@allNarrators'); // Narrators page
Route::get('/narrators-hadith/{id}/{slug}', 'HomeController@narratorHadith'); // Narrators hadith
Route::get('/getTefsser/{bookid}/{hadithid}', 'HomeController@getTefsser'); // Narrators hadith
Route::get('/getTefsserContain/{bookid}/{hadithid}', 'HomeController@getTefsserContain'); // Narrators hadith

Route::get('/search-hadith', 'HomeController@Search'); // Main Search page
Route::get('/single-book/{id}/{slug}/{subject}/{hid?}','HomeController@singlePage');
Route::get('/narrators/{id}/{slug}/','HomeController@narrators'); /*Narrators Information*/
Route::get('/about', 'HomeController@about'); // About page
Route::get('/comment', 'HomeController@comment'); // comment page
Route::post('/addcomment', 'HomeController@addComment'); // add comment page
Route::get('/emailVerify', 'HomeController@emailVerify'); // verify page
Route::get('/deletecookie', 'HomeController@deleteCookie'); // Delete Cookies


/*ajax load and search*/
Route::post('/loadtopic', 'HomeController@loadTopic'); // load more categories (topic)
Route::post('/loadauthor', 'HomeController@loadAuthors'); // load more authors
Route::post('/loadbook', 'HomeController@loadBook'); // load more books
Route::post('/loadallbooks', 'HomeController@loadAllBook'); // load more books
Route::get('/loadtitle', 'HomeController@loadTitle'); // load more title
Route::post('/loadsubtitle', 'HomeController@loadSubTitle'); // load subtitle
Route::post('/loadhadith', 'HomeController@loadHadith'); // load subtitle

Route::get('/searchtopic', 'HomeController@searchTopic'); // search categories (topic)
Route::get('/searchtitle', 'HomeController@searchTitle'); // search title books
Route::get('/searchauthor', 'HomeController@searchAuthor'); // search Author
Route::get('/searchnarrators', 'HomeController@searchNarrators'); // search narrators
Route::get('/loadsearchnarrators', 'HomeController@LoadSearchNarrator'); // Lod search narrators
Route::get('/loadnarratorshadith/{id}', 'HomeController@loadNarratorHadith'); // Lod search narrators
Route::get('/searchbook', 'HomeController@searchBooks'); // search Books
Route::get('/searchallbooks', 'HomeController@searchAllBooks'); // search all Books
Route::get('/loadsearchitem', 'HomeController@searchItem'); // search all Books
Route::get('/loadnarrators', 'HomeController@loadNarrators'); // search all Books

Route::auth();
/*backend*/
Route::get('/logout','BackController@logout');
Route::get('/admins','BackController@index');
Route::get('/loadComment','BackController@loadComment');
Route::post('/sendissus','BackController@sendIssus');
Route::get('/changeissuse/{id}','BackController@changeIssus');




