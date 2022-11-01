<?php

use App\Http\Controllers\TaskController;
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
    return redirect('tasks');
});
Route::post('/tasks/{task}/complete', [TaskController::class, 'completed'])->name('tasks.completed');

Route::resource('/tasks', TaskController::class);


/**
 * Actions Handled By Resource Controller
 * Verb	        URI	                    Action	        Route Name              View
 * GET	        /photos	                index	        photos.index            index.blade.php
 * GET	        /photos/create	        create	        photos.create           create.blade.php
 * POST	        /photos	                store	        photos.store            (r)edirect to action: 'edit' or 'index' or 'create'
 * GET	        /photos/{photo}	        show	        photos.show             show.blade.php
 * GET	        /photos/{photo}/edit	edit	        photos.edit             edit.blade.php
 * PUT/PATCH	/photos/{photo}	        update	        photos.update           (r)edirect to action: 'edit' or 'index'
 * DELETE	    /photos/{photo}	        destroy	        photos.destroy          (r)edirect to action: 'index'
 */