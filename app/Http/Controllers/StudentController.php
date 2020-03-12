<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Student_enrollment;
use App\Models\Student_upload;
use App\Models\Notice;
use App\Models\Semester;
use App\Models\Login;
use App\Models\Comment;
use App\Models\Evaluation;
use App\Models\Supervisor;
use App\Models\Temp_companies;

use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentEnrollment as StudentEnrollmentResource;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('loggedUser')->user_id;

        return view('student',['loggedUser' => session('loggedUser')]);
    }

    public function count()
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }

        

        $intern_v = DB::table('student_enrollments')
                        ->where('internship_status','=',1)
                        ->where('semester_id','=',$s->semester_id)
                        ->count();

        $intern_non_v = DB::table('student_enrollments')
                            ->where('internship_status','=',0)
                            ->where('semester_id','=',$s->semester_id)
                            ->count();

        $registration_v = DB::table('student_enrollments')
                            ->where('registration_status','=',1)
                            ->where('semester_id','=',$s->semester_id)
                            ->count();

        $registration_non_v = DB::table('student_enrollments')
                                ->where('registration_status','=',0)
                                ->where('semester_id','=',$s->semester_id)
                                ->count();

        $batch_v = DB::table('batches')
                        ->where('approved','=',1)
                        ->where('semester_id','=',$s->semester_id)
                        ->count();

        $batch_non_v = DB::table('batches')
                            ->where('approved','=',0)
                            ->where('semester_id','=',$s->semester_id)
                            ->count();
        

        return ['semester' => $s->semester_name,  'batch_v' => $batch_v, 'batch_non_v' => $batch_non_v, 'intern_v' => $intern_v, 'intern_non_v' => $intern_non_v, 'registration_v' => $registration_v, 'registration_non_v' => $registration_non_v];
    }

    public function getStudentStatus()
    {
        
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }

        

        $c = DB::table('students')
                ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                ->select('students.*', 'student_enrollments.*')
                ->where('student_enrollments.semester_id', '=', $s->semester_id)
                ->where('student_enrollments.batch_id', '=', 0)
                ->where('student_enrollments.token_no', '=', 'expired')
                ->count();

        return ['semester' => $s->semester_name,  'students' => $c];
    }

    public function validateStudentEmail(Request $req)
    {
        $e = Student::where('email', '=', $req->email)->first();

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

    public function validateStudentId(Request $req)
    {
        $e = Student::where('student_id', '=', $req->student_id)->first();

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

    public function showAll()
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }


        $student = DB::table('students')
                    ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('students.*', 'student_enrollments.*')
                    ->where('student_enrollments.semester_id', '=', $s->semester_id)
                    ->get();

        return StudentResource::collection($student);
    }

    public function withoutBatch()
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }


        $student = DB::table('students')
                    ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('students.*', 'student_enrollments.*')
                    ->where('student_enrollments.semester_id', '=', $s->semester_id)
                    ->where('student_enrollments.batch_id', '=', 0)
                    ->get();

        return StudentResource::collection($student);
    }

    public function withoutBatchLoad($id)
    {

        $student = DB::table('students')
                    ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('students.*', 'student_enrollments.*')
                    ->where('student_enrollments.semester_id', '=', $id)
                    ->where('student_enrollments.batch_id', '=', 0)
                    ->get();

        return StudentResource::collection($student);
    }

    public function loadStudents($id)
    {
        $student = DB::table('students')
                    ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('students.*', 'student_enrollments.*')
                    ->where('student_enrollments.semester_id', '=', $id)
                    ->get();

        return StudentResource::collection($student);
    }

    public function loadTATeacher()
    {
        $t = DB::table('teachers')
                    ->where('require_TA', '=', 1)
                    ->get();

        return $t;
    }

    public function applyTA(Request $req)
    {
        $s =Student_enrollment::where('student_id', '=', $req->student_id)
                                ->first();
        $s->applied_TA = $req->teacher_id;
        $s->save();
        
        return $s;
    }

    public function removeTA(Request $req)
    {
        $s = Student_enrollment::where('student_id', '=', $req->student_id)
                                ->first();
        $s->applied_TA = 0;
        $s->save();
        
        return $s;
    }

    public function searchStudent($id)
    {
        // $s = Student_enrollment::where('student_id', 'LIKE', '%'.$id.'%')
        //                 ->orWhere('token_nos', 'LIKE', '%'.$id.'%')
        //                 ->get();

        $s =    DB::table('students')
                    ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('students.*', 'student_enrollments.*')
                    ->where('students.student_id', 'LIKE', '%'.$id.'%')
                    ->orWhere('token_no', 'LIKE', '%'.$id.'%')
                    ->get();

        //$response = json_decode($s);
        return $s;
    }

    public function searchStudentDetails($id)
    {
        $s = Student::where('student_id','=',$id)->first();
        $Student_details = '[{
            "StudentName":"MK",
            "StudentId":"16-32435-2",
            "CreditsComplete":142,
            "CourseComplete":54,
            "CGPA":3.82,
             "Semester_details": [
               {"Semester_Name":"2015-2016,Summer", "Course_Id": ["01533","01589"],
            "Course_Name": ["ENGLISH READING SKILLS & PUBLIC SPEAKING","DIFF CALCULUS AND COORDINATE GEOMETRY"],
            "Course_Secion": ["A","F"],
            "Course_Credit" : ["3","3"],
            "Final_Grade" : ["A","A+"],
           "Semester_GPA": 3.77,
           "Semester_CGPA":3.82
            },
            
                {"Semester_Name":"2015-2016,Fall", "Course_Id": ["1","2"],
            "Course_Name": ["A","X"],
            "Course_Secion": ["A","F"],
            "Course_Credit" : ["3","3"],
            "Final_Grade" : ["A","A+"],
           "Semester_GPA": 3.77,
           "Semester_CGPA":3.82
            }
           
             ]
           }]';
        //$response = json_decode($s);
        return $Student_details;
    }

    public function expireToken($id)
    {
        $s = Student_enrollment::where('student_id','=',$id)->first();

        if ($s != null) {
            $s->token_no = 'expired';
            $s->save();
        }
        //$response = json_decode($s);
        return $s;
    }

    public function searchStudentToken($id)
    {
        $s = DB::table('students')
                ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                ->select('students.*', 'student_enrollments.*')
                ->where('students.student_id', $id)
                ->first();

        //$response = json_decode($s);
        return json_encode($s);
    }

    public function studentGivenData($id)
    {
        $student = DB::table('students')
                    ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('students.*', 'student_enrollments.*')
                    ->where('students.student_id', $id)
                    ->first();

        //var_dump($student);
        return json_encode($student) ;
    }

    public function showRegistration()
    {
        $student = DB::table('students')
                    ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('students.name', 'student_enrollments.*')
                    ->where('student_enrollments.semester_id', '=', 0)
                    ->get();

        return StudentEnrollmentResource::collection($student);
    }

    public function showHomeRegistration()
    {
        $student = DB::table('students')
                    ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('students.name', 'student_enrollments.*')
                    ->where('student_enrollments.semester_id', '=', 0)
                    ->orderBy('student_enrollments.registration_status', 'asc')
                    ->limit(10)
                    ->get();

        return StudentEnrollmentResource::collection($student);
    }

    public function showEnrollment()
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }
        $student = DB::table('students')
                    ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('students.name', 'student_enrollments.*')
                    ->where('student_enrollments.semester_id', '=', $s->semester_id)
                    ->get();

        return StudentEnrollmentResource::collection($student);
    }

    public function showHomeEnrollment()
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }
        $student = DB::table('students')
                    ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('students.name', 'student_enrollments.*')
                    ->where('student_enrollments.semester_id', '=', $s->semester_id)
                    ->orderBy('student_enrollments.internship_status', 'asc')
                    ->limit(10)
                    ->get();

        return StudentEnrollmentResource::collection($student);
    }

    public function approveReg($id)
    {
        $e = Student_enrollment::where('student_id', '=', $id)->first();
        $e->registration_status = 1;
        $e->save();

        $student = Student::where('student_id', '=', $id)->first();

        function rand_string( $length ) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            return substr(str_shuffle($chars),0,$length);
        }
        //echo rand_string(8);
        $pass = rand_string(8);
        $data = array('name'=>$student->name, 'id'=>$student->student_id, 'password'=>$pass);

        Mail::send('mail', $data, function($message) use ($student) {
            $message->to($student->email, $student->name)->subject
                ('Aiub Cs Intern Id and Password');
            $message->from('intern@cs.aiub.edu','Admin');
        });

        $l = new Login;

        $l->user_id = $student->student_id;
        $l->name = $student->name;
        $l->password = $pass;
        $l->access_status = 4;
        $l->save();


        return StudentResource::collection(Student::all());
    }

    public function revokeReg($id)
    {
        $e = Student_enrollment::where('student_id', '=', $id)->first();
        $e->registration_status = 0;
        $e->save();

        return StudentResource::collection(Student::all());
    }

    public function approveEn($id)
    {
        $e = Student_enrollment::where('student_id', '=', $id)->first();
        $e->internship_status = 1;
        $e->token_no = $id.uniqid();
        $e->enrollment_date = date("Y-m-d h:i:s");
        $e->save();

        return StudentResource::collection(Student::all());
    }

    public function revokeEn($id)
    {
        $e = Student_enrollment::where('student_id', '=', $id)->first();
        $e->internship_status = 0;
        $e->save();

        return StudentResource::collection(Student::all());
    }

    public function token($id)
    {
        $e = Student_enrollment::where('student_id', '=', $id)->first();
        $e->token_no = $id.uniqid();
        $e->save();

        return StudentResource::collection(Student::all());
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $e = new Student_enrollment;

        $e->student_id = $request->student_id;
        $e->credits_left = $request->credits_left;
        $e->semester_id = $request->semester_id;
        $e->batch_id = $request->batch_id;
        $e->save();

        $student = Student::create($request->all()); 
        return new StudentResource($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function profile($id)
    {
        $e = Student_enrollment::where('student_id', '=', $id)->first();

        return $e ;
    }

    public function profileDetails($id)
    {
        $e = Student::where('student_id', '=', $id)->first();
        return $e ;
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
    public function update(Request $request, $id)
    {
        if ($request->credits_left != null) {
            $e = Student_enrollment::where('student_id', '=', $id)->first();
            $e->credits_left = $request->credits_left;
            $e->semester_id = $request->semester_id;
            $e->batch_id = $request->batch_id;
            $e->save();
        }

        $student = Student::where('student_id', '=', $id)->first();
        $temp = $student->student_id;
        $student->update($request->all());

        $s = Login::where('user_id', '=', $temp)->first();
        $s->name = $request->name;
        $s->save();

        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $se = Student_enrollment::where('student_id', '=', $id)->first();
        if ($se != null) {
            $se->delete();
        }

        $s = Student::where('student_id', '=', $id)->first();
        if ($s != null) {
            $s->delete();
        }

        $l = Login::where('user_id', '=', $id)->first();
        if ($l != null) {
            $l->delete();
        }

        $c = Comment::where('student_id', '=', $id)->first();
        if ($c != null) {
            $c->delete();
        }

        $e = Evaluation::where('student_id', '=', $id)->first();
        if ($e != null) {
            $e->delete();
        }

        $su = Student_upload::where('student_id', '=', $id)->first();
        if ($su != null) {
            $su->delete();
        }

        $super = Supervisor::where('student_id', '=', $id)->first();
        if ($super != null) {
            $super->delete();
        }

        $t = Temp_companies::where('student_id', '=', $id)->first();
        if ($t != null) {
            $t->delete();
        }
        

        return StudentResource::collection(Student::all());
    }
}
