<?php

namespace App\Providers;
use App\Models\Country;
use App\Models\TravelClass;
use App\Models\FlightStatu;
use App\Models\Direction;
use App\Models\City;
use App\Models\Airport;
use App\Models\Airplane;
use App\Models\Airline;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrapFour();

        // هنا تم تعريف التصنيفات وذلك من اجل تسريع العمل حيث انه بدل الاتصال مع القاعدة
        //  عند كل مرة نريد فيها جلب قيم التصنيفات فاننا نجلبها من الكاش
        Cache::rememberForever('countries', function () {
            return Country::all();
        });
        Cache::rememberForever('classes', function () {
            return TravelClass::all();
        });
        Cache::rememberForever('airports', function () {
            return Airport::all();
        });
        Cache::rememberForever('flightStatu', function () {
            return FlightStatu::all();
        });
        Cache::rememberForever('directions', function () {
            return Direction::all();
        });
        Cache::rememberForever('cities', function () {
            return City::all();
        });
        Cache::rememberForever('airports', function () {
            return Airport::all();
        });
        Cache::rememberForever('airplanes', function () {
            return Airplane::all();
        });
        Cache::rememberForever('airlines', function () {
            return Airline::all();
        });
    }
}
