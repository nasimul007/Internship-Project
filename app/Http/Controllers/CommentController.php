<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\Student;
use App\Models\Evaluation;

class CommentController extends Controller
{
    public function showComment($id)
    {
        $c = Comment::where('student_id', '=', $id)->first();

        return $c;
    }

    public function updateComment(Request $req, $id)
    {
        $c = Comment::where('student_id', '=', $id)->first();

        $c->first_comment = $req->first_comment;
        $c->final_comment = $req->final_comment;
        $c->save();

        return $c;
    }

    public function addFirstComment(Request $req, $id)
    {
        $c = new Comment;

        $c->student_id = $id;
        $c->teacher_id = $req->teacher_id;
        $c->first_comment = $req->first_comment;
        $c->first_comment_date = date("Y-m-d h:i:s");
        $c->save();

        return 'success';
    }

    public function addFinalComment(Request $req, $id)
    {
        $c = Comment::where('student_id', '=', $id)->first();

        $c->final_comment = $req->final_comment;
        $c->final_comment_date = date("Y-m-d h:i:s");
        $c->save();

        return 'success';
    }

    
}
