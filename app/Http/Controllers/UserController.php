<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCities;
use Illuminate\Http\JsonResponse;

class UserController extends ApiController
{
    public function saveCity(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'city' => 'required',
            'state' => 'required',
            'country' => 'required'
        ]);
        $result = UserCities::firstOrCreate([
            'user_id' => 1,
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'country' => $request->input('country')
        ]);
        if(!$result)  return $this->code(422)->message(trans('weather.citySaveError'))->json();
        return $this->code(201)->message(trans('weather.citySave'))->json([
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'id' => $result->id
        ]);
    }
    public function getUserCities(): JsonResponse
    {

        return $this->message(trans('weather.userAddCity'))->json(
            UserCities::select('id', 'city')
            ->where('user_id', 1)
            ->get()
            ->toArray()
        );
    }

    public function removeCity(Request $request): JsonResponse
    {
        $result = UserCities::where(['id' => $request->city_id])->delete();
        if(!$result) return $this->code(422)->message(trans('weather.cityDeleteError'))->json();
        return $this->code(204)->json();
    } 
}
