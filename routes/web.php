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
use App\Http\Controllers\HomeController;


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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/getallFlight', [HomeController::class, 'getAllFlight']);
Route::get('/flightDetails/{id}', [HomeController::class, 'flightDetails']);
Route::get('/calculateTotalPrice',[BookingController::class, 'calculateTotalPrice']);
Route::group(['middleware' => ['auth']],function(){
    Route::resource('passenger', PassengerController::class );


});
Route::group(['middleware' => ['auth','passenger']],function(){
    Route::post('booking',[BookingController::class,'store']);
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
    Route::get('booking', [BookingController::class,'index']);
    Route::get('user', [PassengerController::class,'usersIndex']);  
    Route::put('user-admin/{id}', [PassengerController::class, 'toggleAdminStatus']);
    Route::delete('user-destroy/{id}', [PassengerController::class, 'usersDestroy']);
});

Auth::routes();
