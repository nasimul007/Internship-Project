<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

////------------------ Log In --------------------------
	Route::get('/', 'IndexController@index');
	Route::get('/developerProfile', 'IndexController@developerProfile')->name('developerProfile');
	Route::get('/login', 'LoginController@index')->name('login');
	Route::post('/loginVerify', 'LoginController@verify')->name('login.verify');

////----------------- Log Out ----------------------------
	Route::get('/logout', 'LogoutController@index')->name('logout');

////---------------- Reset Password ----------------------
	Route::get('/resetPassEmail', 'LoginController@resetPassEmail');
	Route::get('/resetPage', 'LoginController@resetPage');
	Route::post('/resetPassword', 'LoginController@resetPassword');

////---------------- Registrtion ----------------------
	Route::post('/registrationStore', 'RegistrationController@store')->name('registration.store');	


////------------- Validate student unique id and email -----------
	Route::post('/validateStudentEmail', 'StudentController@validateStudentEmail');
	Route::post('/validateStudentId', 'StudentController@validateStudentId');

////---------------------------- Evaluation ---------------------
	Route::get('/evaluation', 'EvaluationController@index');
	Route::post('/addEvaluation', 'EvaluationController@addEvaluation');

//////---------- Route ------- group ---------------------------

Route::group(['middleware' => ['loginCheck']], function(){

	////------------------ Super Admin ------------------------
	Route::post('/superAdminTeacherLogin', 'SuperAdminController@superAdminTeacherLogin');


	////------------------ Profile ------------------------
	Route::post('/updatePassword', 'LoginController@updatePassword');

	////------------------ Head -----------------------------
	Route::get('/head', 'HeadController@index')->name('head');

	////-------------------- Admin ------------------------
	Route::get('/superAdmin', 'SuperAdminController@index')->name('superAdmin');

	////-------------------- Admin ------------------------
	Route::get('/admin', 'AdminController@index')->name('admin');
	Route::get('/getSemesters', 'SemesterController@index');
	Route::get('/getTeachers', 'TeacherController@showTeacherList');
	Route::get('/getBatches', 'BatchController@showAll');
	Route::get('/getStudentStatus', 'StudentController@getStudentStatus');

	//-------------- Validate teacher unique id and email -----------
	Route::post('/validateTeacherEmail', 'TeacherController@validateTeacherEmail');
	Route::post('/validateTeacherId', 'TeacherController@validateTeacherId');

	////------ Teacher --------
	Route::get('/teacher', 'TeacherController@index')->name('teacher');

	////------ Student --------
	Route::get('/student', 'StudentController@index')->name('student');

});

Route::any('{query}', 
  function() { return redirect('/login'); })
  ->where('query', '.*');