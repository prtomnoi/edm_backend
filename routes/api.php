<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\InfluencerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/provider/{id}', [NewsController::class, 'provider']);
Route::get('/campaigns', [CampaignController::class, 'index']);
Route::get('/influencers', [InfluencerController::class, 'index']);
