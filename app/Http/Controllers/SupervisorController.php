<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Supervisor;

use App\Http\Resources\Supervisor as SupervisorResource;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s = DB::table('student_enrollments')
                ->leftjoin('supervisors', 'supervisors.student_id', '=', 'student_enrollments.student_id')
                ->leftjoin('companies', 'companies.company_id', '=', 'student_enrollments.company_id')
                ->select('companies.*','supervisors.*')
                ->where('supervisors.supervisor_id','!=',null)
                ->get();

        return SupervisorResource::collection($s);
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
        //echo $request->student_id;

        $s = Supervisor::create($request->all()); 
        return SupervisorResource::collection(Supervisor::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $s = Supervisor::where('student_id', '=', $id)->first();

        $s = DB::table('student_enrollments')
                    ->leftjoin('supervisors', 'supervisors.student_id', '=', 'student_enrollments.student_id')
                    ->leftjoin('companies', 'companies.company_id', '=', 'student_enrollments.company_id')
                    ->leftjoin('batches', 'batches.batch_id', '=', 'student_enrollments.batch_id')
                    ->leftjoin('teachers', 'teachers.teacher_id', '=', 'batches.teacher_id')
                    ->select('supervisors.*', 'teachers.*', 'companies.*')
                    ->where('student_enrollments.student_id', '=', $id)
                    ->get();
        
        if ($s != null) {
            return $s;
        }else {
            return ['valid' => false];
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
        $s = Supervisor::findorfail($id);
        $s->update($request->all());
        return SupervisorResource::collection(Supervisor::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s = Supervisor::findorfail($id);
        $s->delete();
        return SupervisorResource::collection(Supervisor::all());
    }
}
