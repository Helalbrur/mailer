<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Message;
use App\Mail\SendMessage;
use Auth;
use Mail;
use Illuminate\Support\Facades\Input;
class HomeController extends Controller
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
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function showMail(){
        return view('show_mail');
    }

    public function sendmail(Request $request){

        $this->validate(request(),[
            'email'=>'required|email',
            'message'=>'required',
            'subject'=>'required'
        ]);
        $data = array('name'=>$request->name,'body'=>$request->message,'subject'=>$request->subject,'email'=>$request->email);
         Mail::send(['text'=>'mail'], $data, function($message) {
            $mail=Input::get('email');
            $sub=Input::get('subject');
             $message->to($mail, 'mail')->subject($sub);
             $message->from('helaluddin.bru@gmail.com','Helal Uddin');
          });
    }
}
