<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Semester;
use App\Models\Student_enrollment;

use App\Http\Resources\Semester as SemesterResource;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SemesterResource::collection(Semester::all());
    }


    public function loadSemester()
    {
        return Semester::where('status', '=', 1)->get();
    }

    public function activeOrLatest()
    {
        $s= Semester::where('status', '=', 1)->first();

        if ($s == null) {
            $s= DB::table('semesters')
                    ->latest('semester_id')
                    ->first();
        }

        return $s;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $s = Semester::create($request->all()); 
        return new SemesterResource($s);
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

    public function loadSemesterName($id)
    {
        $s = Semester::findorfail($id);

        return $s;
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
        Semester::where('status', '=', 1)->update(['status' => 0]);

        $s = Semester::findorfail($id);
        $s->status = 1;
        $s->save();
        return SemesterResource::collection(Semester::all());
    }

    public function changeSemester(Request $request)
    {
        $s=null;

        if($request->subjects_left != null){
            $s = Student_enrollment::where('student_id', '=', $request->student_id)->first();
        
            $s->semester_id = $request->semester_id;
            $s->subjects_left = $request->subjects_left;
            $s->credits_left = $request->credits_left;
            $s->save();
        }
        
        return $s;
    }

    public function inactive(Request $request, $id)
    {
        $s = Semester::findorfail($id);
        $s->status = 0;
        $s->save();
        return SemesterResource::collection(Semester::all());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s = Semester::findorfail($id);
        $s->delete();
        return SemesterResource::collection(Semester::all());
    }
}
