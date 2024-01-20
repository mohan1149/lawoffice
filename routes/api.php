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

Route::post('/user/login','APIController@login');
Route::get('/user/cases/{uid}','APIController@userCases');
Route::get('/user/appointments/{uid}','APIController@userAppointments');
Route::get('/user/invoices/{uid}','APIController@userInvoices');
Route::get('/user/case/details/{case_id}','APIController@getCaseDetails');
Route::get('/user/invoice/details/{invoice_id}','APIController@getInvoiceDetails');
Route::get('/lawyer/timeslots/{lawyer}/{date}','APIController@getTimeSlotsByDate');
Route::get('/lawyer/timeslots/{lawyer}','APIController@getTimeSlots');
Route::get('/all/lawyers','APIController@allLawyers');
Route::get('/case/documents/{case_id}','APIController@caseDocuments');
Route::get('/all/published-sliders','APIController@publishedSliders');
Route::post('/submit/consultation','APIController@submitConsultation');
Route::get('/payment/history/{invoice_id}','APIController@getInvoicePaymentHistory');
Route::post('/submit/appoinment','APIController@submitAppointment');
Route::get('/download/invoice/{invoice_id}','APIController@streamInvoicePDF');
Route::get('/download/case/{case_id}','APIController@streamCasePDF');
Route::get('/download/payment-history/{iph_id}','APIController@streamInvoicePaymentHistoryItem');
Route::post('/upload/user-document','APIController@uploadUserDocument');
Route::post('/request/payment','APIController@requestPayment');
Route::get('/case/histories/{id}','APIController@caseHistories');


