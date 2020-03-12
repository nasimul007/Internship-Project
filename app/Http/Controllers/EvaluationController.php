<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

use App\Models\Evaluation;
use App\Models\Supervisor;
use App\Models\Student;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $s = Student::where('evaluation', '=', $req->token)->first();

        if ($s != null) {
            return view('evaluation',['student' => $s]);
        }else {
            return view('evaluation',['student' => null]);
        }

        
    }

    public function addEvaluation(Request $req)
    {
        $s = Student::where('student_id', '=', $req->student_id)->first();
        $ss = Evaluation::where('student_id', '=', $req->student_id)->first();

        if ($s != null) {
            if ($s->evaluation != 0 && $ss == null) {
                $s->evaluation = 2;
                $s->save();

                $e = new Evaluation;

                $e->student_id = $req->student_id;
                $e->comment = $req->comment;
                $e->question_1 = $req->ans1;
                $e->question_2 = $req->ans2;
                $e->question_3 = $req->ans3;
                $e->question_4 = $req->ans4;
                $e->question_5 = $req->ans5;
                $e->question_6 = $req->ans6;
                $e->question_7 = $req->ans7;
                $e->question_8 = $req->ans8;
                $e->question_9 = $req->ans9;
                $e->question_10 = $req->ans10;

                $e->save();

                return "success";

            }else {
                return "This is not a valid link";
            }
        }else {
            return "Student doesn't exist";
        }

        //return $req->student_id;
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
        $e = Evaluation::where('student_id', '=', $id)->first();

        if ($e != null) {
            return $e;
        }else {
            return ['valid' => false];
        }
    }

    public function sendEvaluationLink($id)
    {
        $super = Supervisor::where('student_id', '=', $id)->first();
        $stu = Student::where('student_id', '=', $id)->first();

        if ($super != null && $stu != null) {

            $uniqId = uniqid().uniqid();
            $stu->evaluation = $uniqId;
            $stu->save(); 

            $data = array('name'=>$super->supervisor_name, 'token'=>$uniqId);

            Mail::send('evaluationMail', $data, function($message) use ($super) {
                $message->to($super->supervisor_email, $super->supervisor_name)->subject
                    ('CS Intern Website Evaluation form');
                $message->from('intern@cs.aiub.edu','No Reply');
            });
            return ['success' => true];

        }else {
            return ['success' => false];
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
