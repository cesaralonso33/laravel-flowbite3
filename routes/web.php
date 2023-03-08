<?php

use App\Http\Controllers\confcolumController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingcradController;
use App\Http\Controllers\UserController;
use App\Models\module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Usernotnull\Toast\Concerns\WireToast;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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

    $items=module::select('name','rute','icon','campolibre')
    ->whereStatus('Active')
    ->get()
    ->map(function($item, $key) {
        if(Auth::user()->hasPermissionTo("view {$item->name}")){
            return [
                'name' => __($item->name),
                'rute'=>$item->rute,
                'icon'=>$item->icon,
                'opc'=>$item->campolibre
            ];
        }
    })->filter();

    $menu= view('setting.menu',compact('items'));
   /*  dd($menu); */
    Cache::put('CacheModule',$menu->render() );


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


