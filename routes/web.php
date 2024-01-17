<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\AirplaneSeatController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\FlightScheduleController;
use App\Http\Controllers\FlightSeatPriceController;
use App\Http\Controllers\BookingController;

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
// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']],function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/getallFlight', [App\Http\Controllers\HomeController::class, 'getAllFlight']);
    Route::resource('passenger', PassengerController::class);


});
Route::group(['middleware' => ['passenger']],function(){
        Route::get('booking',[BookingController::class,'create']);
        Route::get('profile',[PassengerController::class,'profile']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    });
    Route::resource('country', CountryController::class);
    Route::resource('city', CityController::class);
    Route::resource('airport', AirportController::class);
    Route::get('/getCities/{countryId}', [AirportController::class,'getCities']);
    Route::resource('airline', AirlineController::class);
    Route::resource('airplane', AirplaneController::class);
    Route::post('/airplaneSeat/{id}', [AirplaneController::class,'updateAirplaneSeat']);
    
    Route::resource('direction', DirectionController::class);
    Route::resource('flightSchedule', FlightScheduleController::class);
    Route::get('/getAirplanesByAirline/{airlineId}', [FlightScheduleController::class,'getAirplanesByAirline']);
    Route::get('flightSchedule', [FlightScheduleController::class,'index']);
    
    // Route::resource('flightSeatPrice', FlightSeatPriceController::class);
    Route::get('/flightSeatPrice/{flightSchedule_id}', [FlightSeatPriceController::class,'create']);
    Route::post('/flightSeatPrice', [FlightSeatPriceController::class,'store']);


});

Auth::routes();
