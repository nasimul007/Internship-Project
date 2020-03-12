<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Student_upload;
use App\Models\Student_enrollment;

class UploadController extends Controller
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
    public function store(Request $req)
    {
        
    }

    public function uploadCv(Request $req)
    {
        $file = $req->file('file');

        $student = Student_upload::where('student_id', '=', $req->student_id)->first();

        if ($student != null) {
            $student->cv_title = $file->getClientOriginalName();
            $student->cv_path = $file->store('public/storage');
            $student->save();
        }else {
            Student_upload::create([
                'student_id' => $req->student_id,
                'cv_title' => $file->getClientOriginalName(),
                'cv_path' => $file->store('public/storage')
            ]);
        }
        

        return 'success';

        // echo $req->student_id."<br>"; 
        // echo $req->file."<br>";
        // echo $req->subjects_left;
    }


    public function uploadBookReport(Request $req)
    {
        $file = $req->file('file');

        $s = Student_upload::where('student_id', '=', $req->student_id)->first();

        $s->book_report_title = $file->getClientOriginalName();
        $s->book_report_path = $file->store('public/storage');
        $s->book_report_upload_date = date("Y-m-d h:i:s");
        $s->save();

        return 'success';

        // echo $req->student_id."<br>"; 
        // echo $req->file."<br>";
        // echo $req->subjects_left;
    }

    public function uploadAppointmentLetter(Request $req)
    {
        $file = $req->file('file');

        $s = Student_upload::where('student_id', '=', $req->student_id)->first();

        $s->appointment_letter_title = $file->getClientOriginalName();
        $s->appointment_letter_path = $file->store('public/storage');
        $s->apl_upload_date = date("Y-m-d h:i:s");
        $s->save();

        return 'success';

        // echo $req->student_id."<br>"; 
        // echo $req->file."<br>";
        // echo $req->subjects_left;
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

    public function downloadBookReport($id)
    {
        $dl = Student_upload::where('student_id', '=', $id)->first();

        //var_dump($dl);

        return Storage::download($dl->book_report_path, $dl->book_report_title);
    }

    public function deleteBookReport($id)
    {
        $e = Student_upload::where('student_id', '=', $id)->first();
        
        Storage::delete($e->book_report_path);
        
        $e->book_report_title = 'later';
        $e->book_report_path = 'later';
        $e->save();

        return 'success';
    }

    public function downloadCv($id)
    {
        $dl = Student_upload::where('student_id', '=', $id)->first();

        //var_dump($dl);

        return Storage::download($dl->cv_path , $dl->cv_title);
    }

    public function deleteCv($id)
    {
        $e = Student_upload::where('student_id', '=', $id)->first();
        
        Storage::delete($e->cv_path);
        
        $e->cv_title = 'later';
        $e->cv_path = 'later';
        $e->save();

        return 'success';
    }

    public function downloadAppointmentLetter($id)
    {
        $dl = Student_upload::where('student_id', '=', $id)->first();

        //var_dump($dl);

        return Storage::download($dl->appointment_letter_path , $dl->appointment_letter_title);
    }

    public function deleteAppointmentLetter($id)
    {
        $e = Student_upload::where('student_id', '=', $id)->first();
        
        Storage::delete($e->appointment_letter_path);
        
        $e->appointment_letter_title = 'later';
        $e->appointment_letter_path = 'later';
        $e->save();

        return 'success';
    }


    public function loadUploads($id)
    {
        $e = Student_upload::where('student_id', '=', $id)->first();

        if ($e != null) {
            return $e;
        }else {
            return ['valid' => false];
        }
        
        //return json_encode($e);
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
