<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use App\Models\Batch;
use App\Models\Student;
use App\Models\Student_enrollment;
use App\Models\Semester;

use App\Http\Resources\Batch as BatchResource;
use App\Http\Resources\BatchStudents as BatchStudentsResource;

class BatchController extends Controller
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

    public function showAll()
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }

        // $b = DB::table('batches')
        //             ->leftjoin('teachers', 'teachers.teacher_id', '=', 'batches.teacher_id')
        //             ->leftjoin('semesters', 'semesters.semester_id', '=', 'batches.semester_id')
        //             ->leftjoin('student_enrollments', 'student_enrollments.batch_id', '=', 'batches.batch_id')
        //             ->select('batches.*', 'teachers.name', 'semesters.semester_name', DB::raw('count(student_enrollments.batch_id) as students'))
        //             ->where('batches.semester_id', '=', $s->semester_id)
        //             ->groupBy('batch_id')
        //             ->get();
        
        $b = DB::table('batches')
                    ->leftjoin('teachers', 'teachers.teacher_id', '=', 'batches.teacher_id')
                    ->leftjoin('semesters', 'semesters.semester_id', '=', 'batches.semester_id')
                    ->select('batches.*', 'teachers.name', 'semesters.semester_name')
                    ->where('batches.approved', '=', 1)
                    ->where('batches.semester_id', '=', $s->semester_id)
                    ->get();

        //var_dump($b);

        return BatchResource::collection($b);
    }

    public function loadBatches($id)
    {

        $b = DB::table('batches')
                    ->leftjoin('teachers', 'teachers.teacher_id', '=', 'batches.teacher_id')
                    ->leftjoin('semesters', 'semesters.semester_id', '=', 'batches.semester_id')
                    ->select('batches.*', 'teachers.name', 'semesters.semester_name')
                    ->where('batches.approved', '=', 1)
                    ->where('batches.semester_id', '=', $id)
                    ->get();
        //var_dump($b);

        return BatchResource::collection($b);
    }

    public function headBatches()
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }

        $b = DB::table('batches')
                    ->leftjoin('teachers', 'teachers.teacher_id', '=', 'batches.teacher_id')
                    ->leftjoin('semesters', 'semesters.semester_id', '=', 'batches.semester_id')
                    ->select('batches.*', 'teachers.name', 'semesters.semester_name')
                    ->where('batches.semester_id', '=', $s->semester_id)
                    ->get();
        //var_dump($b);

        return BatchResource::collection($b);
    }

    public function loadHeadBatches($id)
    {

        $b = DB::table('batches')
                    ->leftjoin('teachers', 'teachers.teacher_id', '=', 'batches.teacher_id')
                    ->leftjoin('semesters', 'semesters.semester_id', '=', 'batches.semester_id')
                    ->select('batches.*', 'teachers.name', 'semesters.semester_name')
                    ->where('batches.semester_id', '=', $id)
                    ->get();
        //var_dump($b);

        return BatchResource::collection($b);
    }

    public function teacherBatches($id)
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }
        
        $b = DB::table('batches')
                    ->leftjoin('teachers', 'teachers.teacher_id', '=', 'batches.teacher_id')
                    ->leftjoin('semesters', 'semesters.semester_id', '=', 'batches.semester_id')
                    ->select('batches.*', 'teachers.name', 'semesters.semester_name')
                    ->where('batches.teacher_id', '=', $id)
                    ->where('batches.semester_id', '=', $s->semester_id)
                    ->get();
        //var_dump($b);

        return $b;
    }

    public function loadSemesterBatches($t_id, $s_id)
    {
        $b = DB::table('batches')
                    ->leftjoin('teachers', 'teachers.teacher_id', '=', 'batches.teacher_id')
                    ->leftjoin('semesters', 'semesters.semester_id', '=', 'batches.semester_id')
                    ->select('batches.*', 'teachers.name', 'semesters.semester_name')
                    ->where('batches.teacher_id', '=', $t_id)
                    ->where('batches.semester_id', '=', $s_id)
                    ->get();
        //var_dump($b);

        return $b;
    }

    public function teacherStudents($id)
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }

        $b = DB::table('batches')
                    ->leftjoin('student_enrollments', 'student_enrollments.batch_id', '=', 'batches.batch_id')
                    ->leftjoin('supervisors', 'supervisors.student_id', '=', 'student_enrollments.student_id')
                    ->leftjoin('student_uploads', 'student_uploads.student_id', '=', 'student_enrollments.student_id')
                    ->leftjoin('students', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('batches.*', 'students.name', 'students.evaluation', 'student_enrollments.student_id', 'supervisors.supervisor_name','student_uploads.cv_title','student_uploads.appointment_letter_title','student_uploads.book_report_title')
                    ->where('batches.teacher_id', '=', $id)
                    ->where('batches.semester_id', '=', $s->semester_id)
                    ->get();
        //var_dump($b);

        return $b;
    }

    public function loadSemesterStudents($t_id, $s_id)
    {

        $b = DB::table('batches')
                    ->leftjoin('student_enrollments', 'student_enrollments.batch_id', '=', 'batches.batch_id')
                    ->leftjoin('supervisors', 'supervisors.student_id', '=', 'student_enrollments.student_id')
                    ->leftjoin('student_uploads', 'student_uploads.student_id', '=', 'student_enrollments.student_id')
                    ->leftjoin('students', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('batches.*', 'students.name', 'students.evaluation', 'student_enrollments.student_id', 'supervisors.supervisor_name','student_uploads.cv_title','student_uploads.appointment_letter_title','student_uploads.book_report_title')
                    ->where('batches.teacher_id', '=', $t_id)
                    ->where('batches.semester_id', '=', $s_id)
                    ->get();
        //var_dump($b);

        return $b;
    }

    public function batchStudents($id)
    {
        $b = DB::table('batches')
                    ->leftjoin('student_enrollments', 'student_enrollments.batch_id', '=', 'batches.batch_id')
                    ->leftjoin('students', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->select('batches.batch_id', 'students.name', 'student_enrollments.student_id')
                    ->where('batches.batch_id', '=', $id)
                    ->get();
        //var_dump($b);

        return BatchStudentsResource::collection($b);
    }

    public function batchDetails($id)
    {
        $b = DB::table('batches')
                    ->leftjoin('student_enrollments', 'student_enrollments.batch_id', '=', 'batches.batch_id')
                    ->leftjoin('students', 'students.student_id', '=', 'student_enrollments.student_id')
                    ->leftjoin('evaluations', 'evaluations.student_id', '=', 'student_enrollments.student_id')
                    ->leftjoin('comments', 'comments.student_id', '=', 'student_enrollments.student_id')
                    ->select('students.name', 'students.student_id', 'comments.first_comment', 'comments.final_comment', 'evaluations.comment')
                    ->where('batches.batch_id', '=', $id)
                    ->get();
        //var_dump($b);

        return $b;
    }

    public function studentBatchDetails($id)
    {
        $b = DB::table('batches')
                    ->leftjoin('student_enrollments', 'student_enrollments.batch_id', '=', 'batches.batch_id')
                    ->leftjoin('teachers', 'teachers.teacher_id', '=', 'batches.teacher_id')
                    ->select('batches.*', 'teachers.name')
                    ->where('batches.batch_id', '=', $id)
                    ->get();
        //var_dump($b);

        return $b;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
        // {
        //     $total = Student_enrollment::where('batch_id', '0')->count();

        //     $l = intval($total  * .8);
        //     $s = $total  - $l;

        //     for ($i=0; $i < $l; $i++) { 
        //         if($l%8 != 0){
        //             $l = $l - 1;
        //         } else {
        //             break;
        //         }
        //     }
            
        //     $s = $total  - $l;

        //     for ($i=0; $i < $s; $i++) { 
        //         if($s%4 != 0){
        //             $s = $s - 1;
        //         } else {
        //             break;
        //         }
        //     }

        //     $m = $total - ($l + $s);

        //     $l = $l / 8;
        //     $s = $s / 4;

        //     if ($m != 0) {
        //         $s = $s + $m;
        //     }

        //     // echo 'large group : '.$l.'<br>';
        //     // echo 'small group : '.$s.'<br>';
        //     // echo 'missing  : '.$m.'<br>';

        //     $sem = Semester::where('status', '=', 1)->first();
        //     $sl = 1;
        //     for ($i=0; $i < $l; $i++) { 

        //         for ($j=0; $j < 8; $j++) { 
        //             $student = Student_enrollment::where('batch_id', '=', '0')->first();
        //             $student->batch_id = $sem->semester_name.' batch '.$sl;
        //             $student->save();
        //         }
        //         $sl = $sl + 1;
        //     }

        //     for ($i=0; $i < $s; $i++) { 

        //         for ($j=0; $j < 4; $j++) { 
        //             $student = Student_enrollment::where('batch_id', '=', '0')->first();
        //             if( $student == null )
        //                 break;
        //             $student->batch_id = $sem->semester_name.' batch '.$sl;
        //             $student->save();
        //         }
        //         $sl = $sl + 1;
        //     }

        //     //return 'success';

        //     for ($i=1; $i < $sl; $i++) { 
        //         $b = new Batch;
        //         $b->batch_id = $sem->semester_name.' batch '.$i;
        //         $b->semester_id = $sem->semester_id;
        //         $b->save();
        //     }

    // }

    public function create($limit)
    {
        $sem= Semester::where('status', '=', 1)->first();

        if ($sem == null) {
            $sem= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }

        

        $total = DB::table('students')
                ->join('student_enrollments', 'students.student_id', '=', 'student_enrollments.student_id')
                ->select('students.*', 'student_enrollments.*')
                ->where('student_enrollments.semester_id', '=', $sem->semester_id)
                ->where('student_enrollments.batch_id', '=', 0)
                ->where('student_enrollments.token_no', '=', 'expired')
                ->count();

        $numOfBatch = intval($total / $limit);

        for ($i=1; $i <= $numOfBatch; $i++) { 

            for ($j=0; $j < $limit; $j++) { 
                $student = Student_enrollment::where('batch_id', '=', '0')->first();
                $student->batch_id = $sem->semester_name.' batch '.$i;
                $student->save();
            }
        }

        for ($i=1; $i <= $numOfBatch; $i++) { 
            $b = new Batch;
            $b->batch_id = $sem->semester_name.' batch '.$i;
            $b->semester_id = $sem->semester_id;
            $b->save();
        }

    }

    public function selectedCreate($id)
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }

        $batchCount = Batch::where('semester_id', '=', $s->semester_id)->count();

        if ($batchCount == null) {
            $batchCount = 0;
        }

        $batchCount = $batchCount + 1;

        $student = Student_enrollment::where('student_id', '=', $id)->first();
        $student->batch_id = $s->semester_name.' batch '.$batchCount;
        $student->save();
    }

    public function newBatch()
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }

        $batchCount = Batch::where('semester_id', '=', $s->semester_id)->count();

        if ($batchCount == null) {
            $batchCount = 0;
        }

        $batchCount = $batchCount + 1;

        $b = new Batch;
        $b->batch_id = $s->semester_name.' batch '.$batchCount;
        $b->semester_id = $s->semester_id;
        $b->save();
    }

    public function selectedAssign($id, $batch_id)
    {
        // echo $id.'<br>';
        // echo $batch_id.'<br>';

        $student = Student_enrollment::where('student_id', '=', $id)->first();
        $student->batch_id = $batch_id;
        $student->save();
    }

    public function selectedCreateBatch()
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }

        $batchCount = Batch::where('semester_id', '=', $s->semester_id)->count();

        $batchCount = $batchCount + 1;

        $b = new Batch;
        $b->batch_id = $s->semester_name.' batch '.$batchCount;
        $b->semester_id = $s->semester_id;
        $b->save();
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
        $b = Batch::findorfail($id);
        $b->update($request->all());
        return new BatchResource($b);
    }

    public function approveBatch($id)
    {
        $b = Batch::findorfail($id);
        $b->approved = 1;
        $b->save();
        return new BatchResource($b);
    }

    public function revokeBatch($id)
    {
        $b = Batch::findorfail($id);
        $b->approved = 0;
        $b->save();
        return new BatchResource($b);
    }

    public function reqComplete(Request $req)
    {
        $file = $req->file('file');

        $b = Batch::findorfail($req->batch_id);

        if ($b != null) {
            $b->grade_report_title = $file->getClientOriginalName();
            $b->grade_report_path = $file->store('public/storage');
            $b->req_to_complete = 1;
            $b->save();
        }
        
        return new BatchResource($b);
    }

    public function downloadGR($id)
    {
        $dl = Batch::findorfail($id);

        //var_dump($dl);

        return Storage::download($dl->grade_report_path, $dl->grade_report_title);
    }

    public function deleteGR($id)
    {
        $b = Batch::findorfail($id);
        
        Storage::delete($b->grade_report_path);
        
        $b->grade_report_title = 0;
        $b->grade_report_path = 0;
        $b->req_to_complete = 0;
        $b->save();

        return new BatchResource($b);
    }

    public function completeBatch($id)
    {
        $b = Batch::findorfail($id);
        $b->req_to_complete = 2;
        $b->save();
        return new BatchResource($b);
    }

    public function rejectBatch($id)
    {
        $b = Batch::findorfail($id);
        $b->req_to_complete = 0;
        $b->save();
        return new BatchResource($b);
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

    public function deleteBatch($id)
    {
        $b = Batch::where('batch_id', $id)->first();

        $b->delete();

        $bb = Student_enrollment::where('batch_id', '=', $id)->get();

        foreach ($bb as $batch) {
            $s = Student_enrollment::where('student_id', $batch->student_id)->first();

            $s->batch_id = 0;
            $s->save();
        }

        return $bb;
    }
}
