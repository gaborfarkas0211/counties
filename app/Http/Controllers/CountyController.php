<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountyResource;
use App\Models\County;
use Illuminate\Http\JsonResponse;

class CountyController extends Controller
{
    public function getCounties(): JsonResponse
    {
        return $this->sendSuccess(CountyResource::collection(County::getOrderedCounties()));
    }
}
