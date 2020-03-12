<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Notice;

use App\Http\Resources\Notice as NoticeResource;

class NoticeController extends Controller
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

    public function showAllTeacher($id)
    {
        $notices = Notice::where('teacher_id', '=', $id)
                    ->get();

        //var_dump($notices);
        return NoticeResource::collection($notices);
    }

    public function showAllStudent($id)
    {
        $notices = Notice::where('receiver', '=', $id)
                    ->orWhere('receiver', '=', 'all')
                    ->orWhere('receiver', '=', 'student')
                    ->get();

        //var_dump($notices);
        return NoticeResource::collection($notices);
    }

    public function showTeacherNotices($id)
    {
        $notices = Notice::where('receiver', '=', $id)
                    ->orWhere('receiver', '=', 'all')
                    ->orWhere('receiver', '=', 'teacher')
                    ->get();

        //var_dump($notices);
        return NoticeResource::collection($notices);
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
        $notice = Notice::create($request->all()); 
        
        return new NoticeResource($notice);
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

    public function noticeRead($id)
    {
        Notice::where('receiver', '=', $id)
        ->update(['is_read' => 1]);

        return NoticeResource::collection(Notice::all());
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
        $notice = Notice::findorfail($id);
        $notice->update($request->all());
        return new NoticeResource($notice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $e = Notice::where('notice_id', '=', $id)->first();
        $e->delete();
        
        return NoticeResource::collection(Notice::all());
    }
}
