git clone this repo
project setup
1. composer update
2. php artisan migrate
3. create an user 

Email setup 

1. First need to set up 2 step verification on in email
2. go to this link  https://security.google.com/settings/security/apppasswords     and create app
3. copy app password
4. .env file change the following code
	MAIL_DRIVER=smtp
	MAIL_HOST=smtp.gmail.com
	MAIL_PORT=587
	MAIL_USERNAME=helaluddin.bru@gmail.com(your mail address)
	MAIL_PASSWORD=your_app_password
	MAIL_ENCRYPTION=tls
5. in app/config/mail.php file change the following code
	
	return [

	'driver' => env('MAIL_DRIVER', 'smtp'),
	'host' => env('MAIL_HOST', 'smtp.gmail.com'),
	'port' => env('MAIL_PORT', 587),
	'from' => [
	    'address' => env('MAIL_FROM_ADDRESS', 'helaluddin.bru@gmail.com'),
	    'name' => env('MAIL_FROM_NAME', 'Helal Uddin'),
	],
	'encryption' => env('MAIL_ENCRYPTION', 'tls'),
	'username' => env('MAIL_USERNAME'),
	'password' => env('MAIL_PASSWORD'),
	'sendmail' => '/usr/sbin/sendmail -bs',
	'markdown' => [
	    'theme' => 'default',
	    'paths' => [
		resource_path('views/vendor/mail'),
	    ],
	],
	'log_channel' => env('MAIL_LOG_CHANNEL'),
	];


5. paste the following code  in app\route\web.php  
	Route::get('/send/mail', 'HomeController@showMail');
	Route::post('/send/mail', 'HomeController@sendmail')->name('sendmail');

6. make 2 function in HomeController here my code
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

7. create two view 
	a. show_mail 
	b. mail (this name should not be change)

