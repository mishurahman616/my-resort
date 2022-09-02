<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ResortController;
use App\Http\Controllers\Site\ResortController as SiteResortController;
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

//front end Routing
Route::get('/', [SiteResortController::class, 'index']);

//Admin Panel Routing
Route::group(['prefix' => 'admin'], function() {
    //Throttling - An user can hit maximum 3 times in one minute.
    Route::group(['middleware'=>['throttle:3,1', 'isAlreadyAdminLogin']], function(){
        Route::get('login',[AdminController::class, 'loginPage']);  //Login Page
        Route::post('loginCheck',[AdminController::class, 'login'])->name('admin.loginCheck'); //login Data check in controller
    });


    //Only authenticated Admin can access the follwoing route.
    Route::group(['middleware'=>'adminAuthCheck'], function(){
        Route::get('/dashboard',[AdminController::class, 'index']); //Dashboard
        Route::get('/createAdminPage',[AdminController::class, 'createAdmin']); //Admin registration form
        Route::get('/viewAdmins',[AdminController::class, 'viewAdmins']); //View Admins
        Route::get('/adminsData',[AdminController::class, 'getAdminsData']); // get Admins Data 
        Route::post('/addAdmin',[AdminController::class, 'addAdmin'])->name('admin.addAdmin'); //Admin Register Check Controller
        Route::get('/logout',[AdminController::class, 'logout'])->name('admin.logout'); //Admin Register Check Controller

        //Resort Controller
        Route::get('/resorts', [ResortController::class, 'index']);
        Route::get('/createResortPage', [ResortController::class, 'createResort']);
        Route::get('/getResortData', [ResortController::class, 'getResortData']);
        Route::post('/getResortDataById', [ResortController::class, 'getResortDataById']);
        Route::post('/addResort', [ResortController::class, 'addResort'])->name('admin.addResort');
        Route::get('/editResortPage/{id}', [ResortController::class, 'editResortPage']);
        Route::post('/editResort', [ResortController::class, 'editResort'])->name('admin.editResort');
        Route::get('/resortImages/{id}', [ResortController::class, 'resortImages']);
        Route::post('/deleteResort', [ResortController::class, 'deleteResort']);
        Route::post('/addResortImages', [ResortController::class, 'addResortImages'])->name('admin.addResortImages');
        Route::post('/deleteResortImage', [ResortController::class, 'deleteResortImage']);
    });

});
