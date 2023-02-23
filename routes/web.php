<?php

use App\Http\Controllers\confcolumController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingcradController;
use App\Http\Controllers\UserController;
use App\Models\module;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

use Usernotnull\Toast\Concerns\WireToast;
use Usernotnull\Toast\Toast;

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




Route::get('/register', function () {
    return redirect('/login');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $collection = collect( module::select('name')->whereStatus('Active')->get()->toarray());
    Cache::put('CacheModule',$collection );
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/setting', SettingcradController::class);

    Route::resource('/posts', PostController::class);
    Route::post('/pi/dropzone', [PostController::class,'dropzone'] );
    Route::delete('/pi/dropzone', [PostController::class,'dropzonedelete'] );

    Route::resource('/configc', confcolumController::class);

});



require __DIR__.'/auth.php';
