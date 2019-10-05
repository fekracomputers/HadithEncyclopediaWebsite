<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Comments ;
use App\Mail\SendComment ;
use Illuminate\Support\Facades\Mail;
use App\Feedback ;
use Auth ;

class BackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * */
    public function index()
    {
        return view('admins.comments');
    }

    public function login(){
        return view('admins.login');

    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function loadComment(){
        $results = Comments::all();
        return Datatables::of($results)
            ->addColumn('id',function($result){
               return '<h5>'.$result->id.'</h5>' ;
            })
            ->addColumn('comment', function ($result) {
                return '<a href="'.url('changeissuse/'.$result->id).'" ><h5>'.str_limit($result->comment , 100).'</a></h5>' ;
            })
            ->addColumn('email', function ($result) {
                return '<h5>'.str_limit($result->email,30).'</h5>' ;
            })
            ->addColumn('url',function($result){

                return '<a href="'.url($result->url).'" ><h5>'.$result->type .' - '. $result->label.'</h5></a>' ;
            })
            ->addColumn('status', function ($result) {
                return '<h5>'.$result->status.'</h5>' ;
            })
            ->addColumn('date', function ($result) {
                $ex = explode(' ',$result->created_at);
                $date = date_create($ex[0]);
                $res = date_format($date,"Y/m/d");
                return '<h5>'.$res.'</h5>' ;
            })
            ->make(true);
    }

    public function changeIssus($_id){
        $id = $_id ;
        $comm = Comments::find($_id);
        $feed = Feedback::all()->where('comments_id',$id)->first();
        return view('admins.change',compact('id','comm','feed'));
    }

    public function sendIssus(Request $request){
            $comment = nl2br($request->input('comment'));
            $id = $request->input('id');
            $com = Comments::find($id);
            $com->status = 'Resolve' ;
            $com->save();
        $feed = new Feedback();
        $feed->feed = $comment ;
        $feed->comments_id = $id ;
        $feed->save();
            $url = '<a href="'.url($com->url).'" ><h5>'.$com->type .' - '. $com->label.'</h5></a>' ;
            $subject = $com->type .' - '. $com->label;
        Mail::to($com->email)->send(new SendComment($com->comment,
                            $com->created_at,$comment,Carbon::now(),$url,$subject));

        $request->session()->flash('comment', 'Comments Send Successfully');


        return redirect('/admins');

    }
}
require app_path().'/helpers.php';