<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::delete('/admin/users/{user}', 'UserController@destroy')->name('users.destroy');
Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
Route::get('/admin/users/create', [UserController::class, 'create']);
Route::post('/admin/users', [UserController::class, 'store']);
Route::get('/admin/users/{user}/edit', [UserController::class, 'edit']);
Route::patch('/admin/users/{user}', [UserController::class, 'update']);
//Route::delete('/admin/users/{user}', [UserController::class, 'destroy']);

//Route::resource('/admin/users', UserController::class)->except('show');
