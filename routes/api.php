<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('users', 'UserController');

Route::resource('users', 'UserController');
Route::get('students.showAll', 'StudentController@showAll');
Route::post('addStudent', 'RegistrationController@addStudent');


Route::post('superAdmin.teacherLogin', 'SuperAdminController@teacherLogin');


//-------------------------------------------------------- Admin ------------------------------------------------------------


//----------Head (batch) ---------------
Route::get('head.approveBatch/{id}', 'BatchController@approveBatch');
Route::get('head.revokeBatch/{id}', 'BatchController@revokeBatch');
Route::get('head.batches', 'BatchController@headBatches');


//----------Admin (teacher) ---------------
Route::get('teachers.showAll', 'TeacherController@showAll');
Route::get('teachers.showTeacherList', 'TeacherController@showTeacherList');
Route::get('teachers.profile/{id}', 'TeacherController@profile');
Route::post('updatePassword/{id}', 'LoginController@updatePassword');
Route::resource('teachers', 'TeacherController');

//---------- Admin (student) ---------------
Route::get('student.showAll', 'StudentController@showAll');
Route::get('student.loadStudents/{id}', 'StudentController@loadStudents');
Route::get('students.showRegistration', 'StudentController@showRegistration');
Route::get('students.showHomeRegistration', 'StudentController@showHomeRegistration');
Route::get('students.showEnrollment', 'StudentController@showEnrollment');
Route::get('students.showHomeEnrollment', 'StudentController@showHomeEnrollment');
Route::get('students.approveReg/{id}', 'StudentController@approveReg');
Route::get('students.approveEn/{id}', 'StudentController@approveEn');
Route::get('students.revokeReg/{id}', 'StudentController@revokeReg');
Route::get('students.revokeEn/{id}', 'StudentController@revokeEn');
Route::get('students.studentGivenData/{id}', 'StudentController@studentGivenData');
Route::get('students.portalGivenData/{id}', 'StudentController@portalGivenData');
Route::resource('students', 'StudentController');
Route::get('students.count', 'StudentController@count');
Route::get('students.withoutBatch', 'StudentController@withoutBatch');
Route::get('students.withoutBatchLoad/{id}', 'StudentController@withoutBatchLoad');

//----------Admin (notice) ---------------
Route::resource('notices', 'NoticeController');
Route::get('notices.showAllTeacher/{id}', 'NoticeController@showAllTeacher');

//----------Admin (batch) ---------------
Route::resource('batches', 'BatchController');
Route::get('batches.showAll', 'BatchController@showAll');
Route::get('batches.newBatch', 'BatchController@newBatch');
Route::get('batches.create/{limit}', 'BatchController@create');
Route::get('batches.selectedCreate/{id}', 'BatchController@selectedCreate');
Route::get('batches.selectedAssign/{id},{batch_id}', 'BatchController@selectedAssign');
Route::get('batches.selectedCreateBatch', 'BatchController@selectedCreateBatch');
Route::get('batches.completeBatch/{id}', 'BatchController@completeBatch');
Route::get('batches.rejectBatch/{id}', 'BatchController@rejectBatch');
Route::get('batches.batchDetails/{id}', 'BatchController@batchDetails');
Route::get('batches.loadBatches/{id}', 'BatchController@loadBatches');
Route::get('batches.loadHeadBatches/{id}', 'BatchController@loadHeadBatches');
Route::get('batches.deleteBatch/{id}', 'BatchController@deleteBatch');

//----------Admin (semester) ---------------
Route::resource('semesters', 'SemesterController');
Route::get('semesters.showAll', 'SemesterController@showAll');
Route::post('semesters.inactive/{id}', 'SemesterController@inactive');
Route::get('semesters.activeOrLatest', 'SemesterController@activeOrLatest');
Route::get('semesters.loadSemesterName/{id}', 'SemesterController@loadSemesterName');


Route::get('notices.noticeRead/{id}', 'NoticeController@noticeRead');

//----------Admin (supervisors) ---------------
Route::resource('supervisors', 'SupervisorController');


//----------Admin (companies) ---------------
Route::resource('companies', 'CompanyController');
Route::get('companies.studentLoad', 'CompanyController@studentLoad');
Route::post('companies.addExistCompany', 'CompanyController@addExistCompany');
Route::get('companies.teacherLoad/{id}', 'CompanyController@teacherLoad');


Route::get('others.count', 'CompanyController@count');

//----------Admin (TA) ---------------
Route::post('teacher.offerTA', 'TeacherController@offerTA');
Route::get('teacher.terminateOfferTA/{id}', 'TeacherController@terminateOfferTA');
Route::get('teacher.offerTAStatus/{id}', 'TeacherController@offerTAStatus');
Route::get('teacher.appliedTAStudents/{id}', 'TeacherController@appliedTAStudents');
Route::get('teacher.acceptedSemesterStudents/{id}', 'TeacherController@acceptedSemesterStudents');

//----------Admin (Groups) ---------------
Route::get('TA.selectedAccept/{id},{teacher_id}', 'TAController@selectedAccept');
Route::get('TA.selectedReject/{id}', 'TAController@selectedReject');
Route::get('TA.selectedRemove/{id}', 'TAController@selectedRemove');
Route::get('TA.acceptedStudents/{id}', 'TAController@acceptedStudents');
Route::get('TA.selectedAssign/{student_id},{teacher_id}', 'TAController@selectedAssign');



//----------------------------------------------------- Teacher -----------------------------------------------------------------


//---------- Teacher (student) ---------------
Route::get('teacher.teacherStudents/{id}', 'BatchController@teacherStudents');
Route::get('teacher.loadSemesterStudents/{teacher_id},{semester_id}', 'BatchController@loadSemesterStudents');
Route::get('teacher.loadSemesterBatches/{teacher_id},{semester_id}', 'BatchController@loadSemesterBatches');

//---------- Teacher (comment) ---------------
Route::post('teacher.addFirstComment/{id}', 'CommentController@addFirstComment');
Route::post('teacher.addFinalComment/{id}', 'CommentController@addFinalComment');
Route::get('teacher.showComment/{id}', 'CommentController@showComment');
Route::post('teacher.updateComment/{id}', 'CommentController@updateComment');

//---------- Teacher (uploads) ---------------
Route::get('teacher.deleteCv/{id}', 'UploadController@deleteCv');
Route::get('teacher.deleteAppointmentLetter/{id}', 'UploadController@deleteAppointmentLetter');

//---------- Teacher (batch) ---------------
Route::get('teacher.batches/{id}', 'BatchController@teacherBatches');
Route::get('teacher.batchStudents/{id}', 'BatchController@batchStudents');
Route::post('teacher.reqComplete', 'BatchController@reqComplete');
Route::get('teacher.downloadGR/{id}', 'BatchController@downloadGR');
Route::get('teacher.deleteGR/{id}', 'BatchController@deleteGR');

//----------Teacher (notice) ---------------
Route::get('notices.showTeacherNotices/{id}', 'NoticeController@showTeacherNotices');

//---------- Teacher (company) ---------------
Route::get('teacher.verifyCompany/{id}', 'CompanyController@verifyCompany');
Route::get('teacher.disproveCompany/{id}', 'CompanyController@disproveCompany');
Route::get('teacher.teacherChangeCompanyLoad/{id}', 'CompanyController@teacherChangeCompanyLoad');
Route::get('teacher.teacherChangeCompanyDelete/{id}', 'CompanyController@teacherChangeCompanyDelete');
Route::get('teacher.oldCompany/{id}', 'CompanyController@oldCompany');
Route::get('teacher.newCompany/{id}', 'CompanyController@newCompany');
Route::post('teacher.updateReqToChange', 'CompanyController@updateReqToChange');


//---------- Teacher (evaluation) ---------------
Route::resource('evaluations', 'EvaluationController');
Route::get('evaluations.sendEvaluationLink/{id}', 'EvaluationController@sendEvaluationLink');

////----------------------------Teacher ( Search Student) ---------------------
Route::get('teachers.searchStudent/{id}', 'StudentController@searchStudent');
Route::get('teachers.searchStudentDetails/{id}', 'StudentController@searchStudentDetails');
Route::get('teachers.searchStudentToken/{id}', 'StudentController@searchStudentToken');
Route::get('teachers.expireToken/{id}', 'StudentController@expireToken');


//------------------------------------------------------------ Student -------------------------------------------------------------

//---------- Student (profile) ---------------
Route::get('student.loadTATeacher', 'StudentController@loadTATeacher');
Route::post('student.applyTA', 'StudentController@applyTA');
Route::post('student.removeTA', 'StudentController@removeTA');

//---------- Student (profile) ---------------
Route::get('student.profile/{id}', 'StudentController@profile');
Route::get('student.profileDetails/{id}', 'StudentController@profileDetails');

//---------- Student (token) ---------------
Route::get('student.token/{id}', 'StudentController@token');

//---------- Student (notice) ---------------
Route::get('notices.showAllStudent/{id}', 'NoticeController@showAllStudent');

//---------- Student (upload) ---------------
Route::post('student.uploadCv', 'UploadController@uploadCv');
Route::post('student.uploadAppointmentLetter', 'UploadController@uploadAppointmentLetter');
Route::post('student.uploadBookReport', 'UploadController@uploadBookReport');

//---------- Student (download) ---------------
Route::get('student.downloadFile/{id}', 'UploadController@studentDownloadFile');
Route::get('student.downloadCv/{id}', 'UploadController@downloadCv');
Route::get('student.downloadAppointmentLetter/{id}', 'UploadController@downloadAppointmentLetter');
Route::get('student.downloadBookReport/{id}', 'UploadController@downloadBookReport');

Route::get('student.deleteBookReport/{id}', 'UploadController@deleteBookReport');

Route::get('student.loadUploads/{id}', 'UploadController@loadUploads');

//---------- Student (semester) ---------------
Route::get('student.loadSemester', 'SemesterController@loadSemester');
Route::post('student.changeSemester', 'SemesterController@changeSemester');

//---------- Student (batch) ---------------
Route::get('student.batchDetails/{id}', 'BatchController@studentBatchDetails');

//---------- Student (company) ---------------
Route::get('student.searchCompany/{name}', 'CompanyController@searchCompany');
Route::get('student.searchCompanyDetails/{id}', 'CompanyController@searchCompanyDetails');
Route::get('student.loadReqForChange/{id}', 'CompanyController@loadReqForChange');
Route::post('companies.addReqForChange', 'CompanyController@addReqForChange');

