<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers as Backend;
/*
use App\Http\Controllers\Backend as Backend;
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test-connection', function () {
    try {
        DB::connection()->getPdo();
        return "Database connection is successful!";
    } catch (\Exception $e) {
        return "Database connection failed: " . $e->getMessage();
    }
});


// Route::get('/', function () { return view('login'); });
Route::get('/', [Backend\LoginController::class, 'getLogin']);
Route::post('/', [Backend\LoginController::class, 'postLogin']);
Route::get('logout', [Backend\LoginController::class, 'logOut']);
// Route::get('regis', [LoginController::class, 'createDummy']);

Route::group(['middleware' => ['Admin']], function () {
    Route::get('/index' , [Backend\HomeController::class , 'index'])->name('admin.home');
    Route::post('/uploadimage_text', [Backend\FunctionController::class, 'uploadimage_text'])->name('upload');
    //== News
    Route::resource('/news' , Backend\NewsController::class);
    Route::get('/news/status/{id}', [Backend\NewsController::class, 'status'])->where(['id' => '[0-9]+']);
    //== Influencer
    Route::resource('/influencer' , Backend\InfluencerController::class);
    Route::get('/influencer/status/{id}', [Backend\InfluencerController::class, 'status'])->where(['id' => '[0-9]+']);
    //== Campaign
    Route::resource('/campaign' , Backend\CampaignController::class);
    Route::get('/campaign/status/{id}', [Backend\CampaignController::class, 'status'])->where(['id' => '[0-9]+']);
    //== Account
    Route::resource('/account' , Backend\AccountController::class);

});

