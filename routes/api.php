<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => ['api']], function() {
	Route::post('auth/login', 'App\Http\Controllers\AuthController@login');
});
// transferencia
Route::post('transfers/getbyrangedate', 'App\Http\Controllers\TransferenciaController@getByRangeDate');
Route::get('transfers/all', 'App\Http\Controllers\TransferenciaController@all');
Route::post('transfers/changestatus', 'App\Http\Controllers\TransferenciaController@changeStatus');
// ajuste
Route::post('settings/getbyrangedate', 'App\Http\Controllers\AjusteController@getByRangeDate');
Route::get('settings/all', 'App\Http\Controllers\AjusteController@all');
Route::post('settings/changestatus', 'App\Http\Controllers\AjusteController@changeStatus');
Route::post('settings/changeaccountingaccount', 'App\Http\Controllers\AjusteController@changeAccountingAccount');

//users
Route::get('users/all', 'App\Http\Controllers\UserController@all');
Route::post('users/create', 'App\Http\Controllers\UserController@store');
Route::put('users/update/{id}', 'App\Http\Controllers\UserController@update');
Route::delete('users/delete/{id}', 'App\Http\Controllers\UserController@delete');

//rols
Route::get('rols/all', 'App\Http\Controllers\RolController@all');
Route::post('rols/create', 'App\Http\Controllers\RolController@store');
Route::post('rols/update/{id}', 'App\Http\Controllers\RolController@update');
Route::delete('rols/delete/{id}', 'App\Http\Controllers\RolController@delete');

//application_modules
Route::get('application-modules/all', 'App\Http\Controllers\ApplicationModuleController@all');

Route::post('receptions/direcepcionesdf/getbyrangedate', 'App\Http\Controllers\ReceptionController@getDIRecepcionesDFbyRangeDate');
Route::post('receptions/direcepcionesdf/getbyrangedateandfolio/{folio}', 'App\Http\Controllers\ReceptionController@getDIRecepcionesDFbyRangeDateAndFolio');
Route::post('receptions/direcepcionesgfaut/getbyrangedate', 'App\Http\Controllers\ReceptionController@getDIRecepcionesGFAUTbyRangeDate');
Route::post('receptions/direcepcionesgfaut/getbyrangedateandreserva/{reserva}', 'App\Http\Controllers\ReceptionController@getDIRecepcionesDFbyRangeDateAndReserva');