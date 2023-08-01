<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\CampaignController;

/*
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


Route::get('/', function () {
    return view('login');
});

Route::get('/index' , [HomeController::class , 'index'])->name('admin.home');

Route::prefix('news')->group(function () {

});

Route::resource('/news' , NewsController::class);
Route::get('/news/status/{id}', [NewsController::class, 'status'])->where(['id' => '[0-9]+']);

Route::resource('/influencer' , InfluencerController::class);
Route::get('/influencer/status/{id}', [InfluencerController::class, 'status'])->where(['id' => '[0-9]+']);

Route::resource('/campaign' , CampaignController::class);
Route::get('/campaign/status/{id}', [CampaignController::class, 'status'])->where(['id' => '[0-9]+']);
