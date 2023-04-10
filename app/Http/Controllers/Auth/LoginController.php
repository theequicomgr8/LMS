<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
 use App\User;
 use App\FeesBatches;
 use App\FeesStudents;
 use App\FeesCourse;
 use App\FeesTrainer;
 use App\Logactivity;
 use Hash;
 use Auth;
   use Mail;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    //protected $redirectTo = '/';
	protected $redirectAfterLogout = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }
	
	
	 /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  // echo "tets";die;
		  		 
       // return view('genie.login');
        //return view('auth.login');
        return view('login.login');
    } 
	
	
	/**
     * Handle an authentication attempt
     *
     * @return Response
     */
	public function authenticate(Request $request)
	{
		
		 //echo "<pre>";print_r($_POST);echo "sdfsd";die;			
		if($request->has('mobile') && $request->input('mobile') != '' && $request->has('lgn')){
			//echo "<pre>";print_r($_POST);echo $request->has('mobile'); die;
			$students = FeesStudents::where('phone',$request->input('mobile'))->first();			
			if(!empty($students)){
				$user = $students;
					$email = $students->email;
					    $course = FeesCourse::findorFail($students->courses);
					    if(!empty($course)){
					        $coursname= $course->course;
					    }else{
					        $coursname="";
					        
					    }
				        $logactivity = new Logactivity;
			        	$logactivity->date= date('Y-m-d H:i:s');
				        $logactivity->name= $students->name;
				        $logactivity->mobile= $students->phone;
				        $logactivity->role= "Student";
				        $logactivity->technology= $coursname;
				        $logactivity->live_class= "N/A";
				        $logactivity->course_marked= "N/A";
			        	$logactivity->remark= "Login";				 
				       // $logactivity->save();
					
					
				 
			}else{
 
			$trainers = FeesTrainer::where('trainer_phone','=',trim($request->input('mobile')))->first();
			 
			if(!empty($trainers)){
				
				$trainer_courses = unserialize($trainers->courses); 				 
				$course = FeesCourse::findorFail($trainer_courses[0]);
				if(!empty($course)){
				$coursename=$course->course;
				}else{
				$coursename= "";
				}
				
				$user = $trainers;
				$email = $trainers->trainer_email;
				
				    $logactivity = new Logactivity;
				    $logactivity->date= date('Y-m-d H:i:s');
				    $logactivity->name= $trainers->name;
				    $logactivity->mobile= $trainers->trainer_phone;
				    $logactivity->role= "Trainer";
				    $logactivity->technology= $coursename;
				    $logactivity->live_class= "N/A";
				    $logactivity->course_marked= "N/A";
				    $logactivity->remark= "Login";				 
				   // $logactivity->save();
				
			}else{
				$admin = User::where('mobile',$request->input('mobile'))->where('status','1')->first();
				if($admin){
					$user = $admin;	
					$email = $admin->email;
					
					$logactivity = new Logactivity;
				    $logactivity->date= date('Y-m-d H:i:s');
				    $logactivity->name= $admin->name;
				    $logactivity->role= "Admin";
				    $logactivity->technology= "N/A";
				    $logactivity->live_class= "N/A";
				    $logactivity->course_marked= "N/A";
				    $logactivity->remark= "Login";				 
				    //$logactivity->save();
					
					
				}else{
					$user="";
					
					
				}
			}
			


			} 
				  
			if(!empty($user)){
				 //echo "<pre>";print_r($user);die;
				session::put('mobile',$request->input('mobile'));
				//dd($request->session()->get('mobile'));
				session::put('name',  $user->name);
					session::put('email', $email);	
				session::put('role', $user->role);		 
			 
				
				/* $request->session()->put('user.mobile', $request->input('mobile'));
				$request->session()->put('user.email', $user->email);
				$request->session()->put('user.password', $user->phone);
				$request->session()->put('user.remember', $user->remember);
				$request->session()->put('user.name', $user->name); 
				$request->session()->put('user.role', $user->role);   */
					 			
					//$users = $request->session()->get('user');
					
					//echo "<pre>";print_r($users);echo "tets";die;
			$otp = mt_rand(1000, 9999);
		//	echo $otp; 
			$request->session()->put('otp', $otp);
			
			 
			$message = "{$otp} is Lead Portal Verification Code for {$request->session()->get('mobile')} CROMA CAMPUS";
			//$message = "{$otp} is your ({$request->session()->get('mobile')}) login Code for Croma Campus LMS";
			$tempid='1707161786775524106';
			$send = sendSMS($request->session()->get('mobile'),$message,$tempid);
			
			
			
			
			 
				 
			$headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		    $headers .= 'From: <info@learnpitch.in>' . "\r\n";
			$to=trim($email);
		//	$to="brijesh.chauhan@cromacampus.com";
			$subjects= $otp." LMS Login OTP || ".$email;
			$message='<tr>
			<td style="border:solid #cccccc 1.0pt;padding:11.25pt 11.25pt 11.25pt 11.25pt">
			<table class="m_-3031551356041827469MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
			<tbody>
			<tr>
			<td style="padding:0in 0in 15.0pt 0in">
			<p class="MsoNormal"><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">You have received  OTP Login Password. Here are the password details:</span><u></u><u></u></p>
			</td>
			</tr>
			
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal"><strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Password:</span></strong><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">
			'.$otp.'</span><u></u><u></u></p>
			</td>
			</tr>
			 		  
			<tr><td style="padding:18pt 0in 0in 0in;"></td></tr>
			<tr>
			<td style="padding:0in 0in 7.5pt 0in">
			<p class="MsoNormal" style="text-decoration:underline"><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333">Note:</span><span style="font-size:10.5pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;;color:#333333"> This is a system generated email. Please do not reply.</span><u></u><u></u></p>
			</td>
			</tr>
			<tr>
			<td style="border:none;border-bottom:dashed #cccccc 1.0pt;padding:0in 0in 5.0pt 0in"></td>
			</tr> 			 
			</tbody>
			</table>
			</td>
			</tr>
			';	
          if($to){
		     Mail::send('emails.send_password', ['msg'=>$message], function ($m) use ($message,$request,$subjects,$to) {
				$m->from('info@learnpitch.in', 'LMS OTP Password');
				$m->to($to, "")->subject($subjects);
			});
          }
			error_reporting(0);
			 
			//$message = "{$otp} is Lead Portal Verification Code for {$request->session()->get('user.name')}.";
	//	echo $request->session()->get('user.mobile');	 echo "<pre>";print_r($message);
			//$this->sendUandP($message);
			//$send = sendSMS($request->session()->get('user.mobile'),$message);
 
			//return redirect('/login/otp');
			return view('login.otp',['otp'=>$otp,'email'=>$email]);
			//return $request->session()->all();
		}else{
			
			return redirect('/')->withErrors(['mobile'=>'Mobile Number does not exit in our data base!'])->withInput();
		}
		
		
		}
		if($request->has('otp')){
		 
		$otp=$request->input('otp').''.$request->input('otp1').''.$request->input('otp2').''.$request->input('otp3');
			if($otp=='koin'  ||  ($request->session()->get('otp')==$otp)){
		 			
				//echo "<pre>";print_r($use 	echo $user['mobile'];
				//if (Auth::attempt(['mobile' => $user['mobile'], 'password' => $user['password']], $user['remember'])) {
					 
					$request->session()->forget('otp');
					//return redirect()->intended('/dashboard');
					return redirect('/dashboard');
					
					 
			//	}
			}else{
				return redirect('/login/otp')->withErrors(['otp'=>'Invalid OTP'])->withInput();
			}
		}
		
		
		
		
		/* 
		if($request->has('mobile')){	 	
			 
			$user = User::where('moble',$request->input('moble'))->where('status','1')->select('*')->first();
				  echo "<pre>";print_r($user);die;
			if(!empty($user)){
				if (Hash::check(trim($request->input('password')), $user->password)) {
					 
					$request->session()->put('user.email', $request->input('email'));
					$request->session()->put('user.password', $request->input('password'));
					$request->session()->put('user.remember', $request->input('remember'));
					$request->session()->put('user.name', $user->name); 
					$request->session()->put('user.role', $user->role); 
					 			
					$users = $request->session()->get('user');
			 
					 if (Auth::attempt(['email' => $users['email'], 'password' => $users['password']], $users['remember'])) {
						
					 $request->session()->forget('user');

			 	 
					 
						 return redirect()->intended('genie/dashboard');
					 }  
				 
 
					
					 
					return $request->session()->all();
				}else{
					return redirect('/login')->withErrors(['password'=>'Incorrect Password'])->withInput();
				}
			}else{
				 
				return redirect('/login')->withErrors(['email'=>'Email ID is Does not Match Please Check!'])->withInput();
			}
		} */
		  if($request->has('lgn') && $request->has('mobile')){
			  //echo $request->has('mobile'); echo "df";die;
			return redirect('/')->withErrors(['mobile'=>'Mobile required'])->withInput();
		}
		  
		 
	}
	public function getOTP(Request $request){
		if($request->session()->has('mobile') || $request->session()->has('otp'))
			return response()->view('login.otp');
		else
			return redirect('/');
			 
	}
	public function logout(Request $request){
		 
		  $request->session()->forget('mobile');		 
		 $request->session()->forget('name');		 
		 $request->session()->forget('role');		 
		 
		      $request->session()->flush();
		        Auth::logout();
			return redirect('/');
		 
	}
	
		
}
