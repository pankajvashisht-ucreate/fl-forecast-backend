<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCities;
use Illuminate\Http\JsonResponse;

class WeatherController extends ApiController
{
    
    public function weatherInfo(Request $request): JsonResponse{
        $location = UserCities::where('id', '=', $request->city_id)->first();
        if (empty($location)) {
            return $this->code(404)->message(trans('weather.noLocation'))->json();
        }
        $weather = app('forecast')->city($location->city)->stateAndCountry([
            'state' => $location->state,
            'country' => $location->country
        ])->weather()->result();
        if(!$weather){
            return $this->code(404)->message(trans('weather.noResult'))->json();
        }
        return $this->message(trans('weather.weatherInfo'))->json($weather);
    }

    public function forecastInfo(Request $request): JsonResponse{
        $location = UserCities::where('id', '=', $request->city_id)->first();
        if (empty($location)) {
            return $this->code(404)->message(trans('weather.noLocation'))->json();
        }
        $weather = app('forecast')->city($location->city)->stateAndCountry([
            'state' => $location->state,
            'country' => $location->country
        ])->forecast()->result();
        if(!$weather){
            return $this->code(404)->message(trans('weather.noResult'))->json();
        }
        return $this->message(trans('weather.forecastInfo'))->json($weather);
    }

}
