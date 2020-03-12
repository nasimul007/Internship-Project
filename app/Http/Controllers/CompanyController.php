<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Student_enrollment;
use App\Models\Temp_companies;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Company::all();
    }

    public function count()
    {
        $v = Company::where('verified','=',1)
                    ->count();

        $n = Company::where('verified','=',0)
                    ->count();

        $c = DB::table('semesters')
                ->count();
        
        $t = DB::table('teachers')
                ->count();
                
        $s = DB::table('supervisors')
                ->count();

        $students = DB::table('students')
                ->count();

        return ['company_v' => $v, 'company_non_v' => $n, 'semesters' => $c, 'teachers' => $t, 'supervisors' => $s, 'students' => $students];
    }

    public function studentLoad()
    {
        return Company::where('verified', '=', 1)->get();
    }

    public function teacherLoad($id)
    {
        $c = DB::table('student_enrollments')
                ->leftjoin('companies', 'companies.company_id', '=', 'student_enrollments.company_id')
                ->leftjoin('batches', 'batches.batch_id', '=', 'student_enrollments.batch_id')
                ->select('companies.*','student_enrollments.student_id')
                ->where('batches.teacher_id', $id)
                ->where('companies.company_id','!=',null)
                ->orderby('companies.verified', 'asc')
                ->get();

        return $c;
    }

    public function teacherChangeCompanyLoad($id)
    {
        $c = DB::table('student_enrollments')
                ->leftjoin('batches', 'batches.batch_id', '=', 'student_enrollments.batch_id')
                ->leftjoin('temp_companies', 'temp_companies.student_id', '=', 'student_enrollments.student_id')
                ->select('temp_companies.*','student_enrollments.student_id')
                ->where('batches.teacher_id', $id)
                ->where('temp_companies.company_id','!=',null)
                ->get();

        return $c;
    }

    public function teacherChangeCompanyDelete($id)
    {
        $c = Temp_companies::where('company_id', '=', $id)->first();
        $c->delete();
        return Company::all();
    }

    public function oldCompany($id)
    {
        $c = Company::Where('company_id', '=', $id)->first();  
        
        return $c;
    }

    public function newCompany($id)
    {
        $c = Temp_companies::Where('company_id', '=', $id)->first();  
        
        return $c;
    }

    public function updateReqToChange(Request $req)
    {
        $c = Company::where('company_id','=',$req->company_id)->first();

        if ($c != null) {
            $c->company_name = $req->company_name;
            $c->company_type = $req->company_type;
            $c->company_address = $req->company_address;
            $c->company_contact = $req->company_contact;
            $c->company_website = $req->company_website;

            $c->save();

            $cc = Temp_companies::where('company_id', '=', $req->company_id)->first();
            $cc->delete();
        }
        

        return json_encode([
            'valid' => true
        ]);
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
        $c = Company::create($request->all());

        if ($request->student_id != null) {
            $s = Student_enrollment::where('student_id', '=', $request->student_id)->first();

            $com = Company::where([
                'company_name' => $request->company_name,
                'company_type' => $request->company_type,
                'company_website' => $request->company_website,
             ])->first();

             $s->company_id = $com->company_id;
             $s->save();
        }

        return Company::all();
    }

    public function addReqForChange(Request $req)
    {
        $c = new Temp_companies;

        $c->student_id = $req->student_id;
        $c->company_id = $req->company_id ;
        $c->company_name = $req->company_name;
        $c->company_type = $req->company_type;
        $c->company_address = $req->company_address;
        $c->company_contact = $req->company_contact;
        $c->company_website = $req->company_website;

        $c->save();

        return json_encode([
            'valid' => true
        ]);
    }

    public function loadReqForChange($id)
    {
        $s = Temp_companies::Where('student_id', '=', $id)->first();

                    
        if ($s != null) {
            return json_encode([
                'valid' => false
            ]);
        }else {
            return json_encode([
                'valid' => true
            ]);
        }
    }

    public function searchCompany($name)
    {
        $s = Company::where('company_name', 'LIKE', '%'.$name.'%')
                    ->Where('verified', '=', 1)
                    ->get();


        //$response = json_decode($s);
        return $s;
    }

    public function searchCompanyDetails($id)
    {
        $s = Company::Where('company_id', '=', 1)->first();

                    
        //$response = json_decode($s);
        return $s;
    }

    public function addExistCompany(Request $request)
    {
        if ($request->student_id != null) {
            $s = Student_enrollment::where('student_id', '=', $request->student_id)->first();

             $s->company_id = $request->company_id;
             $s->save();
        }

        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $s = DB::table('student_enrollments')
                    ->leftjoin('companies', 'companies.company_id', '=', 'student_enrollments.company_id')
                    ->select('companies.*')
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

    public function verifyCompany($id)
    {
        $s = Company::where('company_id', '=', $id)->first();

        $s->verified = 1;
        $s->save();

        return Company::all();
    }

    public function disproveCompany($id)
    {
        $s = Company::where('company_id', '=', $id)->first();

        $s->verified = 0;
        $s->save();

        return Company::all();
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
        $c = Company::where('company_id', '=', $id)->first();
        $c->update($request->all());
        return Company::all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $c = Company::where('company_id', '=', $id)->first();
        $c->delete();
        return Company::all();
    }
}
