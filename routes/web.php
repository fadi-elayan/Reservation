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


use App\Image;
use App\Item;
use App\Notifications\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('email' , 'EmailController@index')->middleware('verified');


/* Route for user  */




/* end */


/* Route for Admin */
Route::middleware(['auth' ,'Admin' ,'verified'])->group( function () {


    Route::get('/Admin' ,'AdminController@index' );
    Route::get('/show' ,'CompanyController@create' );
    Route::post('/add/company' , 'CompanyController@store');
    Route::get('/delete/company/{id}' , 'AdminController@destroy')->middleware('IsCompanyExist');
    Route::get('/add/information/{id}' , 'CompanyController@createInformation')->name('add.company')->middleware('IsCompanyExist');
    Route::post('Admin/add/company/information/{id}' , 'CompanyController@storeInformatio');
    Route::get('/show/all/company' , 'CompanyController@showCompany');
    Route::get('/show/company/items/{id}' ,'CompanyController@show' )->middleware('IsCompanyExist');

});


/*Route for Company */
Route::middleware(['auth' , 'company' , 'verified'])->group( function () {

    Route::get('/company' , 'CompanyController@index');
    Route::get('/company/upload/{id}' , 'CompanyController@edit');
    Route::post('/add/company/information/{id}' ,'CompanyController@update');
    Route::get('/add/company/item' , 'ItemController@create');
    Route::post('/add/company/item' , 'ItemController@store');
    Route::get('/show/company/item/{id}' , 'ItemController@show');
    Route::get('delete/company/item/{id}' , 'ItemController@destroy')->middleware('IsMy');
    Route::get('display/company/item/{id}' ,'ItemController@display')->middleware('IsMy');
    Route::get('delete/company/item/photo/{id}' , 'ItemController@delete')->middleware('IsMyImage');
    Route::get('show/company/notification/{id}' , 'NotificationController@show')->middleware('IsMyNotification');
    Route::get('accept/company/notification/{id}' , 'NotificationController@accept')->middleware('IsMyNotification');
    Route::get('reject/company/notification/{id}' , 'NotificationController@reject')->middleware('IsMyNotification');
    Route::get('times/company/reservation/{id}' , 'ReservationController@bookedTimeForCompany')->middleware(['IsExicst' , 'IsMy']);

});




/* end */

Route::middleware(['auth' , 'user' ,'verified'])->group( function () {

    Route::get('/home', 'UserController@index')->name('home');
    Route::get('/display/item/{id}' , 'UserController@display')->middleware('IsExicst');
    Route::get('/delete/item/reservation/{id}' , 'ReservationController@destroy')->middleware('IsMyReservation');
    Route::post('/reservation/company/item/{id}' , 'ReservationController@reservation');
    Route::get('show/user/notification/{id}' , 'NotificationController@showForUser')->middleware('IsMyNotification');
    Route::get('show/user/all/notification' , 'NotificationController@allNotificationForUser');
    Route::get('times/reservation/{id}' , 'ReservationController@bookedTime')->middleware('IsExicst');
    Route::get('/user/search/item' , 'UserController@search');
    Route::get('/user/search/items/{keys}' , 'UserController@searchEnter');
});
