<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

use App\Models\Login;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;


class LoginController extends Controller
{
    public function index(Request $request)
    {
        $u = Semester::where('status','=',1)->first();
        
        if($u != null)
        {
            $temp = $request->session()->put('semester', $u);
        }

        //return view('login',['loggedUser' => session('loggedUser')]);
        if (session('loggedUser') == null) {
            return view('login',['semester' => session('semester')]);
        }else {
            if (session('loggedUser')->access_status == 1) {
                return redirect()->route('head');
            }
            else if (session('loggedUser')->access_status == 2) {
                return redirect()->route('admin');
            }
            else if (session('loggedUser')->access_status == 3) {
                return redirect()->route('teacher');
            }
            else if (session('loggedUser')->access_status == 4) {
                return redirect()->route('student');
            }
            else if (session('loggedUser')->access_status == 0) {
                return redirect()->route('superAdmin');
            }
        }
        
    }

    public function resetPassEmail(Request $req)
    {
        $user_id = $req->user_id;
        $uniqId = uniqid().uniqid();

        $u = Login::where('user_id','=',$user_id)->first();

        if ($u != null) {
            if ($u->access_status == 4) {
                $s = Student::where('student_id','=',$user_id)->first();
                if ($s != null) {
                    $l = Login::where('user_id','=',$user_id)->first();
                    $l->reset_pass = $uniqId;
                    $l->save();

                    $data = array('name'=>$s->name, 'id'=>$s->student_id, 'token'=>$uniqId);

                    Mail::send('resetMail', $data, function($message) use ($s) {
                        $message->to($s->email, $s->name)->subject
                            ('CS Intern Website Password Reset');
                        $message->from('intern@cs.aiub.edu','No Reply');
                    });
                    return 'success';
                }else {
                    return "failed";
                }
            }else {
                $t = Teacher::where('teacher_id','=',$user_id)->first();
                if ($t != null) {
                    return $t->email;
                }else {
                    return "failed";
                }
            }
        }else {
            return "failed";
        }
    }

    public function resetPage(Request $req)
    {
        return view('resetPass');
    }

    public function resetPassword(Request $req)
    {
        $pass = $req->newPass;
        $token = $req->token;
        $u = Login::where('reset_pass','=',$token)->first();

        if ($u != null) {
            $u->reset_pass = 0;
            $u->password = $pass;
            $u->save();

            return "success";
        }else {
            return "failed";
        }
    }

    public function verify(Request $request)
    {
    	$userid = $request->userid;
    	$password = $request->password;
        
        $user = new Login;

    	$u = $user->where([
					       'user_id' => $userid,
					       'password' => $password
						])->first();

    	if($u != null)
    	{
            $temp = $request->session()->put('loggedUser', $u);

            //echo session('loggedUser')->name;

            return "success";

    	}
    	else
    	{
    		return "error";
    	}
    }

    public function updatePassword(Request $req)
    {
        //echo $req->user_id;

        $userId = $req->user_id;
        $oldPass = $req->oldPass;
        $newPass = $req->newPass;

        $u = Login::where([
                        'user_id' => $userId,
                        'password' => $oldPass
                        ])->first();

        if($u != null)
        {
            $u->password = $newPass;
            $u->save();
            return 'success';
        }else {
            return 'failed';
        }
        
    }
}
