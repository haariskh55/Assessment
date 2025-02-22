<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VisitController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/track-visit/{externalId}', [VisitController::class, 'trackVisit']);
Route::post('/update-stage', [VisitController::class, 'updateStage']);
