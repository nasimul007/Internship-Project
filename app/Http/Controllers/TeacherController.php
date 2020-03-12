<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TeacherRequest;
use Mail;

use Illuminate\Support\Facades\DB;
use App\Models\Teacher;
use App\Models\Notice;
use App\Models\Login;
use App\Models\Student_enrollment;

use App\Http\Resources\Teacher as TeacherResource;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('loggedUser')->user_id;

        return view('teacher',['loggedUser' => session('loggedUser')]);
    }

    public function showAll()
    {   
        $t = DB::table('teachers')
                ->join('logins', 'logins.user_id', '=', 'teachers.teacher_id')
                ->select('teachers.*')
                ->where('logins.access_status', '!=', 0)
                ->where('logins.access_status', '!=', 1)
                ->get();

        return TeacherResource::collection($t);
    }

    public function showTeacherList()
    {   
        $t = Teacher::where('access_status', '=', 3)
                    ->get();

        return TeacherResource::collection($t);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function validateTeacherEmail(Request $req)
    {
        $e = Teacher::where('email', '=', $req->email)->first();

        if ($e != null) {
            return json_encode([
                'valid' => false,
                'message' => 'Email address already exist!'
            ]);
        }else {
            return json_encode([
                'valid' => true
            ]);
        }
    }

    public function validateTeacherId(Request $req)
    {
        $e = Teacher::where('teacher_id', '=', $req->teacher_id)->first();

        if ($e != null) {
            return json_encode([
                'valid' => false,
                'message' => 'Id already exist!'
            ]);
        }else {
            return json_encode([
                'valid' => true
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teacher = Teacher::create($request->all());

        function rand_string( $length ) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            return substr(str_shuffle($chars),0,$length);
        }
        //echo rand_string(8);
        $pass = rand_string(8);
        $data = array('name'=>$request->name, 'id'=>$request->teacher_id, 'password'=>$pass);

        Mail::send('mail', $data, function($message) use ($request) {
            $message->to($request->email, $request->name)->subject
                ('Aiub Cs Intern Id and Password');
            $message->from('intern@cs.aiub.edu','Admin');
        });

        $l = new Login;

        $l->user_id = $request->teacher_id;
        $l->name = $request->name;
        $l->password = $pass;
        $l->access_status = $request->access_status;
        $l->save();
        
        return new TeacherResource($teacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $s = Supervisor::where('student_id', '=', $id)->first();

        if ($s != null) {
            return $s;
        }else {
            return ['valid' => false];
        }
    }

    public function offerTA(Request $req)
    {
        //echo 'hello';
        $t = Teacher::where('teacher_id', '=', $req->teacher_id)
                    ->first();

        if ($t != null) {

            $t->require_TA = 1;
            $t->TA_courses = $req->courses;
            $t->TA_position = $req->position;
            $t->save();

            return $t;
        }else {
            return 'failed';
        }
    }
    
    public function offerTAStatus($id)
    {
        //echo 'hello';
        $t = Teacher::where('teacher_id', '=', $id)
                    ->first();

        if ($t != null) {
            return $t->require_TA;
        }else {
            return 'failed';
        }
    }

    public function terminateOfferTA($id)
    {
        //echo 'hello';
        $t = Teacher::where('teacher_id', '=', $id)
                    ->first();

        if ($t != null) {

            $t->require_TA = 0;
            $t->save();

            return 'success';
        }else {
            return 'failed';
        }
    }

    public function appliedTAStudents($id)
    {
        //echo 'hello';
        $s = DB::table('students')
                ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                ->select('students.name', 'student_enrollments.*')
                ->where('student_enrollments.applied_TA', $id)
                ->where('student_enrollments.TA_confirmed','!=', 1)
                ->get();

        if ($s != null) {

            return $s;
        }else {
            return 'failed';
        }
    }
    
    public function profile($id)
    {   
        //echo $id;

        $e = Teacher::where('teacher_id', '=', $id)->first();

        return $e;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $teacher = Teacher::findorfail($id);
        $temp = $teacher->teacher_id;
        $teacher->update($req->all());

        //echo $temp;

        $t = Login::where('user_id', '=', $temp)->first();
        $t->name = $req->name;
        $t->user_id = $req->teacher_id;
        $t->save();

        return new TeacherResource($teacher);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::where('teacher_id', '=', $id)->first();
        $teacher->delete();

        $t = Login::where('user_id', '=', $id)->first();
        $t->delete();
        return new TeacherResource($teacher);
    }
}
