<?php

use App\Http\Controllers\BoilerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\InstallerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostcodeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderQuoteController;
use App\Http\Controllers\RadiatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('apply-order', [OrderController::class, 'applyOrder']);
Route::post('apply-order-quote', [OrderQuoteController::class, 'applyOrderQuote']);

Route::post('contact-us', [ContactController::class, 'sendMail']);

Route::get('check-postcode', [PostcodeController::class, 'checkPostcodeExist']);

Route::prefix('installers')->group(function() {
    Route::post('store', [InstallerController::class, 'store']);
});

Route::prefix('boilers')->group(function() {
    Route::get('/', [BoilerController::class, 'index']);
    Route::get('survey-result', [BoilerController::class, 'surveyResultBoilers']);
    Route::get('{id}', [BoilerController::class, 'show']);
});

Route::prefix('radiators')->group(function() {
    Route::get('parameters', [RadiatorController::class, 'parameters']);
    Route::get('get-radiator', [RadiatorController::class, 'getRadiator']);
});

Route::prefix('products')->group(function() {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('controllers', [ProductController::class, 'getControllers']);
});

Route::prefix('faqs')->group(function () {
    Route::get('/', [FaqController::class, 'index']);
    Route::get('search', [FaqController::class, 'search']);
});

Route::prefix('blog')->group(function () {
    Route::get('/', [PostController::class, 'index']);
});
