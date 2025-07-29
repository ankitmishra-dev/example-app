<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Router;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Client\PendingRequest;

Route::get('/', function () {
    return view('welcome');
});



