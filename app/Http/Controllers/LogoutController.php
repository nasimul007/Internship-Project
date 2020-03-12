<?php

namespace App\Http\Controllers;
session_start();
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index()
    {
    	session()->flush();
    	session_destroy();

		//var_dump($count);
    	return redirect()->route('login');
    }
}
