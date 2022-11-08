<?php

use App\Helpers\PaginationHelper;
use App\Http\Controllers\Api\AuthController;
use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
    Route::get('/laundry/{id}', function ($id) {

        $laundry = Laundry::with('services', 'user')->findOrFail($id);

        $lat = request('lat');
        $lng = request('lng');

        if ($lat && $lng) {
            $laundry->distance = (float) number_format(6371 *
                acos(
                    cos(deg2rad($lat))
                        * cos(deg2rad($laundry->lat))
                        * cos(deg2rad($laundry->long) - deg2rad($lng))
                        + sin(deg2rad($lat))
                        * sin(deg2rad($laundry->lat))
                ), 2);
        }

        $laundry->image = asset('img/laundry') . '/' . $laundry->image;
        $laundry->has_pickup = Arr::random([true, false]);
        $laundry->rate = rand(1, 5);
        $laundry->services = $laundry->services->map(function ($item) {
            $item->icon = asset('img/laundry') . '/' . $item->icon;
            return $item;
        });

        return collect($laundry)->except(['user_id', 'lat', 'long', 'created_at', 'updated_at']);
    });

    Route::get('/laundry', function () {
        $lat = request('lat') or abort(404);
        $lng = request('lng') or abort(404);

        $laundry = Laundry::all();

        $laundry = $laundry->map(function ($item) use ($lat, $lng) {
            $distance = (float) number_format(6371 *
                acos(
                    cos(deg2rad($lat))
                        * cos(deg2rad($item->lat))
                        * cos(deg2rad($item->long) - deg2rad($lng))
                        + sin(deg2rad($lat))
                        * sin(deg2rad($item->lat))
                ), 2);

            return [
                ...collect($item)->except(['user_id', 'lat', 'long', 'created_at', 'updated_at']),
                'distance' => $distance,
                'image' => asset('img/laundry') . '/' . $item->image,
                'has_pickup' => Arr::random([true, false]),
                'rate' => rand(1, 5),
                'cheapest_price' => $item->services()->orderBy('price', 'ASC')->first()->price
            ];
        });

        $laundry = collect($laundry);
        $filter = request('filter');
        switch ($filter) {
            case 'cheapest':
                $result = $laundry->sortBy('cheapest_price')->values()->all();
                break;
            case 'top-rated':
                $result = $laundry->where('rate', '>=', 4)->sortByDesc('rate')->values()->all();
                break;
            case 'pickup':
                $result = $laundry->where('has_pickup', true);
                break;
            default:
                $result = $laundry->sortBy('distance')->values()->all();
                break;
        }

        return PaginationHelper::paginate(collect($result), 10)->withQueryString();
    });
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
