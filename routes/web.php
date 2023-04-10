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


 if (version_compare(PHP_VERSION, '7.4.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

/*  Route::get('/login', function () {
    return view('genie.login');
}); */ 
 
//Auth::routes();
 Route::get('/',function(){
	if(Auth::check()){
	 
		return redirect(url('/dashboard'));
	}else{		
	
		//return redirect(url('/'));
		return redirect('/');
	}
}); 

/* Route::group(['prefix' => 'genie'], function() {
	Route::auth();	
}); */
//Auth::routes();
 //Route::auth();
 
Route::get('/login', function () {
	echo "tets";
    return view('auth.login');
});
Route::get('/', 'Auth\LoginController@index');
//Route::get('/login', 'Auth\LoginController@index');
Route::get('/check', 'Auth\LoginController@index');
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/login/check', 'Auth\LoginController@authenticate');
Route::get('/login/check', 'Auth\LoginController@getOTP');
Route::get('/login/otp', 'Auth\LoginController@getOTP');
Route::post('/login/otp', 'Auth\LoginController@authenticate');
Route::get('/trainer', 'Genie\TrainerController@index');
Route::get('/trainer/profile', 'Genie\TrainerController@profile');
Route::post('/trainer/picimage/{id}', 'Genie\TrainerController@picimage');
Route::get('/trainer/del_picimage/{id}', 'Genie\TrainerController@delpicimage');

Route::get('/students', 'Genie\StudentsController@student');
Route::get('/students/getstudents', 'Genie\StudentsController@getstudentspagination');
Route::get('/student/profile', 'Genie\StudentsController@profile');
Route::post('/student/profile-update', 'Genie\StudentsController@profileUpdate');
Route::post('/student/picimage/{id}', 'Genie\StudentsController@picimage');
Route::get('/student/del_picimage/{id}', 'Genie\StudentsController@delpicimage');
Route::get('/student/first-feedback', 'Genie\StudentsController@firstFeedback');
Route::post('/student/first-feedback-save', 'Genie\StudentsController@firstFeedbackSave');

Route::get('/student/second-feedback', 'Genie\StudentsController@secondFeedBack');
Route::post('/student/second-feedback-save', 'Genie\StudentsController@secondFeedbackSave');

Route::get('/student/third-feedback', 'Genie\StudentsController@thirdFeedBack');
Route::post('/student/third-feedback-save', 'Genie\StudentsController@thirdFeedbackSave');
Route::get('/student/job', 'Genie\StudentsController@job');
Route::get('/student/jobs/details/{jobid}', 'Genie\StudentsController@jobDetail');

Route::get('/student/student-attendance', 'Genie\StudentsController@studentAttendance');
Route::get('/student/course-offer', 'Genie\StudentsController@courseOffer');

Route::get('/student/feed-back', 'Genie\StudentsController@feedBack');
Route::get('/student/fees-details', 'Genie\StudentsController@feesDetails');
Route::get('/student/course-contents', 'Genie\StudentsController@courseContents');
Route::get('/student/student-batch', 'Genie\StudentsController@studentBatch');
Route::get('/student/feed-back-question', 'Genie\StudentsController@feedBackQuestion');
Route::post('/student/feedbackQuestion-save', 'Genie\StudentsController@feedBackQuestion');


Route::post('/student/querySave', 'Genie\StudentsController@querySave');
Route::post('/student/referEarnSave', 'Genie\StudentsController@referEarnSave');

Route::post('/student/studentSlipReceipt', 'Genie\StudentsController@studentSlipReceipt');
Route::get('/student/getAttention/{id}', 'Genie\StudentsController@getAttention');

Route::get('/attendance', 'Genie\TrainerController@attendance');
Route::get('/roomallotment', 'Genie\TrainerController@roomallotment');


Route::get('/users', 'Genie\UserController@index');
Route::get('/users/get-user', 'Genie\UserController@getUserPagination');
Route::get('/users/add', 'Genie\UserController@add');
Route::post('/users/add', 'Genie\UserController@store');
Route::get('/users/edit/{id}', 'Genie\UserController@edit');
Route::post('/users/edit/{id}', 'Genie\UserController@edit');
 
Route::get('/users/delete/{id}', 'Genie\UserController@deleted');
 
Route::get('/dashboard/{id?}', 'Genie\DashboardController@index');
 
 
 
 
 
 
 
 Route::get('/course/add', 'Genie\CourseController@add');
 Route::post('/course/add', 'Genie\CourseController@add');
 Route::get('/course', 'Genie\CourseController@index');
 Route::get('/course/get-course', 'Genie\CourseController@getCoursePagination');
 
Route::get('/course/get-course-content-form/{id}','Genie\CourseController@getCourseContentForm');	
Route::post('/course/saveCourseContent/{id}', 'Genie\CourseController@saveCourseContent');

Route::get('/course/get-course-content-batch-form/{bid}/{cid}','Genie\CourseController@getCourseContentBatchForm');	
Route::post('/course/saveCourseBatchContent/{bid}/{cid}', 'Genie\CourseController@saveCourseBatchContent');
Route::get('/course/course-view/{id}', 'Genie\CourseController@courseView');
Route::get('/course/course-edit/{id}', 'Genie\CourseController@courseedit');
Route::get('/course/delete/{id}', 'Genie\CourseController@deleted');
Route::get('/course/deleteCourseContentBatch/{bid}/{cid}', 'Genie\CourseController@deleteCourseContentBatch');
Route::get('/course/tempCourseContentdelete/{bid}/{cid}', 'Genie\CourseController@tempCourseContentdelete');
Route::get('/course/courseVideodelete/{id}', 'Genie\CourseController@courseVideodelete');
Route::get('/course/courseNotesdelete/{id}', 'Genie\CourseController@courseNotesdelete');
Route::get('/course/courseAssignmentdelete/{id}', 'Genie\CourseController@courseAssignmentdelete');

Route::get('/course/get-course-video-form/{id}','Genie\CourseController@getCourseVideoForm');	
Route::post('/course/saveCourseVideo/{h_id}/{b_id}/{c_id}/{t_id}', 'Genie\CourseController@saveCourseVideo'); 
Route::post('/course/adminSaveCourseVideo/{h_id}/{c_id}', 'Genie\CourseController@adminSaveCourseVideo'); 
Route::post('/course/adminSaveCourseNotes/{h_id}/{c_id}', 'Genie\CourseController@adminSaveCourseNotes'); 
Route::post('/course/adminSaveCourseAssignment/{h_id}/{c_id}', 'Genie\CourseController@adminSaveCourseAssignment'); 

Route::get('/course/get-course-notes-form/{id}','Genie\CourseController@getCourseNotesForm');	


Route::post('/course/saveCourseNotes/{h_id}/{b_id}/{c_id}/{t_id}', 'Genie\CourseController@saveCourseNotes'); 

Route::post('/course/saveCourseAssignment/{h_id}/{b_id}/{c_id}/{t_id}', 'Genie\CourseController@saveCourseAssignment'); 
Route::post('/course/saveCourseAssignment', 'Genie\CourseController@saveCourseAssignment'); 
Route::post('/course/course-heading-status', 'Genie\CourseController@courseHeadingStatus');
Route::post('/course/course-content-status', 'Genie\CourseController@courseContentStatus');
Route::post('/course/course-subcontent-status', 'Genie\CourseController@courseSubContentStatus');
Route::post('/course/course-lastcontent-status', 'Genie\CourseController@courseLastContentStatus');
 
 
Route::get('/invoice/pay-invoice', 'Genie\InvoiceController@payInvoice');
Route::get('/invoice/get-pay-invoice', 'Genie\InvoiceController@getPayInvoicePagination');

Route::post('/invoice/batch-generate-invoice', 'Genie\InvoiceController@getBatchinvoicePrintPdf');
Route::post('/invoice/get-generate-invoice', 'Genie\InvoiceController@getinvoicePrintPdf');
Route::post('/invoice/invoiceGenerated', 'Genie\InvoiceController@invoiceGenerated');
Route::get('/invoice/paid-invoice', 'Genie\InvoiceController@paidInvoice');
Route::get('/invoice/get-paid-invoice', 'Genie\InvoiceController@getPaidInvoicePagination');
Route::get('/invoice/get-invoice-pay/{id}','Genie\InvoiceController@getInvoicePay');	
Route::get('/invoice/get-invoice-payment-list/{id}','Genie\InvoiceController@getInvoicePaymentList');	
Route::get('/invoice/pay-history', 'Genie\InvoiceController@payHistory');
Route::get('/invoice/get-pay-trainer-history', 'Genie\InvoiceController@getPayHistoryPagination');

Route::get('/log/day-log', 'Genie\LogController@daylog');
Route::get('/log/get-day-log', 'Genie\LogController@getDayLogPagination');

Route::get('/batch/running-batches', 'Genie\BatchController@runningBatches');
Route::get('/batch/batch-details/work', 'Genie\BatchController@viewBatchDetailswork');
Route::get('/batch/batch-details/{id}', 'Genie\BatchController@viewBatchDetails');
Route::get('/batch/get-view-batch-details', 'Genie\BatchController@getviewBatchDetailsPagination');
Route::get('/batch/get-running-batches', 'Genie\BatchController@getRunningBatchesPagination');
Route::get('/batch/get-finished-batches', 'Genie\BatchController@getFinishedBatchesPagination');
Route::get('/batch/finished-batches', 'Genie\BatchController@finishedBatches');
Route::post('/batch/attendance', 'Genie\BatchController@attendance');

Route::post('/batch/studentsAttendanceGoogleMeeting/{s_id}', 'Genie\BatchController@studentsAttendanceGoogleMeeting');
Route::post('/batch/trainerAttendanceGoogleMeeting/{b_id}/{t_id}', 'Genie\BatchController@trainerAttendanceGoogleMeeting');

Route::get('/batch/course-status/{val}/{id}', 'Genie\BatchController@batchCourseStatus');
Route::get('/batch/get-trainer-course/{val}/{id}', 'Genie\BatchController@getTrainerCourse');
Route::get('/batch/get-batch-content-form/{b_id}/{c_id}/{t_id}','Genie\BatchController@getCourseContentDetails');	
 Route::get('/batch/get-google-meeting-form/{b_id}/{c_id}/{t_id}','Genie\BatchController@getGoogleMeetingForm');
  Route::get('/batch/course-contents/{b_id}/{c_id}/{t_id}', 'Genie\BatchController@courseContentsDetails');
//Clear Cache facade value:
/*
Route::get('clear/clear-cache', function() {
    
	$exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');    
    $exitCode = Artisan::call('cache:clear');    
    $exitCode = Artisan::call('optimize');
    return '<h1>Cache facade value cleared</h1>';
});*/


Route::get('/backup', 'Genie\DatabaseBackup@index');

Route::get('/checkmail', 'Genie\BatchController@checkmail');

Route::post('/grev', 'Genie\GrevienceController@index');
Route::any('/grev-list', 'Genie\GrevienceController@show');


Route::get('/grev-data','Genie\GrevienceController@showlist');






