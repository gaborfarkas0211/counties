<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Models\County;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CityController extends Controller
{
    public function store(StoreCityRequest $request, County $county): JsonResponse
    {
        $city = new City([
            'name' => $request->input('name'),
        ]);

        if ($city = $county->cities()->save($city)) {
            return $this->sendSuccess($city);
        }

        return $this->sendError([], Response::HTTP_BAD_REQUEST);
    }
}
