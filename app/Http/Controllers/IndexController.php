<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $n = DB::table('notices')
                ->leftjoin('teachers', 'teachers.teacher_id', '=', 'notices.teacher_id')
                ->get();

        return view('index', [ 'notices' => $n ]);
        
    }

    public function developerProfile()
    {
        return view('developerProfile');
    }
}
