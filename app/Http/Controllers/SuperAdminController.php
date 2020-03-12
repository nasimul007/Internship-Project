<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superAdmin',['loggedUser' => session('loggedUser')]);
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

    public function superAdminTeacherLogin(Request $req)
    {

        $object = (object) ['name' => session('loggedUser')->name, 'user_id' => $req->user_id];


        if (session('loggedUser')->password == $req->password) {
            if ($req->access_status == 1) {
                return view('head',['loggedUser' => $object]);
            }
            else if ($req->access_status == 2) {
                return view('admin',['loggedUser' => $object]);
            }
            else if ($req->access_status == 3) {
                return view('teacher',['loggedUser' => $object]);
            }
            else if ($req->access_status == 4) {
                return view('student',['loggedUser' => $object]);
            }
            
        }else {
            echo "Wrong password";
            //echo session('loggedUser')->password;
        }
        
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
