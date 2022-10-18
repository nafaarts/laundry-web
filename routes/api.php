<?php

use App\Http\Controllers\Api\AuthController;
use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => ['auth:api']], function () {
    // Route::get('/test', function () {
    //     return response([
    //         'message' => 'ok',
    //         'user' => auth('api')->user()
    //     ]);
    // });
});

Route::get('/get-nearest-area', function () {
    $swLat = request('swLat') or abort(404);
    $swLng = request('swLng') or abort(404);
    $neLat = request('neLat') or abort(404);
    $neLng = request('neLng') or abort(404);

    $laundry = Laundry::whereBetween('lat', [$swLat, $neLat])
        ->whereBetween('long', [$swLng, $neLng])
        ->get();

    return $laundry;
});

Route::get('/laundry/{id}', function ($id) {
    $laundry = Laundry::with('user')->findOrFail($id);
    return [
        ...collect($laundry)->except('image'),
        'image' => asset('img/laundry') . '/' . $laundry->image
    ];
});

Route::get('/laundry', function () {
    $lat = request('lat') or abort(404);
    $lng = request('lng') or abort(404);

    $laundry = Laundry::with('user')->select(
        "*",
        DB::raw("6371 * acos(cos(radians(" . $lat . "))
    * cos(radians(laundries.lat))
    * cos(radians(laundries.long) - radians(" . $lng . "))
    + sin(radians(" . $lat . "))
    * sin(radians(laundries.lat))) AS distance")
    )
        ->groupBy("laundries.id")
        ->orderBy("distance", 'ASC')
        ->paginate(10)->withQueryString();

    return $laundry;
});
