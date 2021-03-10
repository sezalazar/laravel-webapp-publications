<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\CommentController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(


);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {


/* Publications - Init */
    Route::get('/indexPublication', [App\Http\Controllers\PublicationController::class, 'index']);
    Route::get('/publicationsHola', [App\Http\Controllers\PublicationController::class, 'getApprovedHolaPublications']);

    Route::get('/create', [App\Http\Controllers\PublicationController::class, 'create']);
    Route::post('/addPublication', [App\Http\Controllers\PublicationController::class, 'store']);

    Route::get('/edit/{idPublication}', [App\Http\Controllers\PublicationController::class, 'edit']);
    Route::post('/publication/{idPublication}', [App\Http\Controllers\PublicationController::class, 'update']);

    Route::resource('/publication', PublicationController::class);
    /* Publications - End */

    Route::get('/view/{idPublication}', [App\Http\Controllers\CommentController::class, 'index']);

    Route::post('/addComentario', [App\Http\Controllers\CommentController::class, 'store']);

    Route::get('envioMail', ['as' => 'enviar', function () {
        $data = [' '];
        \Mail::send('envioMail', $data, function ($message) {
            $message->from('288e243db6-1ddb1b@inbox.mailtrap.io', 'Sebastian');
            $message->to('288e243db6-1ddb1b@inbox.mailtrap.io')->subject('Notificación comentario ingresado');
        });
        // // return "Se envío el email";
        return view('envioMail');
    }]);
});


Route::get('/', [App\Http\Controllers\PublicationController::class, 'index']);



