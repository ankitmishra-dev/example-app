<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Product1\Cat;
use App\Product1\Pet;
use Illuminate\Http\Client\PendingRequest;

class AnimalServiceController extends Controller
{
    public function __invoke(Pet $pet)
    {
        $a = $pet->getPetCall(new Cat);
        $http = app(PendingRequest::class);
    }
}
