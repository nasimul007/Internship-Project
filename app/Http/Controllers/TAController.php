<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\Supervisor;
use App\Models\Student_enrollment;

class TAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    public function selectedAccept($id, $teacher_id)
    {
        //echo $teacher_id;
        $s = Student_enrollment::where('student_id', '=', $id)
                                ->first();

        if ($s != null) {

            $s->TA_confirmed = 1;
            $s->company_id = 1;
            $s->save();

            $t = Teacher::where('teacher_id', '=', $teacher_id)
                        ->first();

            $sup = new Supervisor;

            $sup->supervisor_name = $t->name;
            $sup->supervisor_number = $t->mobileNo;
            $sup->supervisor_email = $t->email;
            $sup->supervisor_designation = 'Teacher';
            $sup->student_id = $id;
            $sup->save();

            return $s;
        }else {
            return 'failed';
        }
    }

    public function selectedReject($id)
    {
        //echo 'hello';
        $s = Student_enrollment::where('student_id', '=', $id)
                                ->first();

        if ($s != null) {

            $s->applied_TA = 0;
            $s->TA_confirmed = 0;
            $s->save();

            return $s;
        }else {
            return 'failed';
        }
    }

    public function selectedRemove($id)
    {
        //echo 'hello';
        $s = Student_enrollment::where('student_id', '=', $id)
                                ->first();

        if ($s != null) {

            $s->TA_confirmed = 0;
            $s->save();

            return $s;
        }else {
            return 'failed';
        }
    }

    public function selectedAssign($student_id, $teacher_id)
    {
        //echo 'hello';
        $s = Student_enrollment::where('student_id', '=', $student_id)
                                ->first();

        if ($s != null) {

            $s->TA_confirmed = 1;
            $s->applied_TA = $teacher_id;
            $s->save();

            return $s;
        }else {
            return 'failed';
        }
    }

    public function acceptedStudents($id)
    {
        $ss= Semester::where('status', '=', 1)->first();

        if ($ss == null) {
            $ss= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }

        //echo 'hello';
        $s = DB::table('students')
                ->join('student_enrollments', 'student_enrollments.student_id', '=', 'students.student_id')
                ->select('students.name', 'student_enrollments.*')
                ->where('student_enrollments.applied_TA', $id)
                ->where('student_enrollments.semester_id', $ss->semester_id)
                ->where('student_enrollments.TA_confirmed','=', 1)
                ->get();

        if ($s != null) {

            return $s;
        }else {
            return 'failed';
        }
    }

    public function acceptedSemesterStudents($id, $teacher_id )
    {
        //echo 'hello';
        $s = DB::table('students')
                ->join('student_enrollments', 'student_enrollments.student_id', '=', 'students.student_id')
                ->select('students.name', 'student_enrollments.*')
                ->where('student_enrollments.applied_TA', $teacher_id)
                ->where('student_enrollments.semester_id', $id)
                ->where('student_enrollments.TA_confirmed','=', 1)
                ->get();

        if ($s != null) {

            return $s;
        }else {
            return 'failed';
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
