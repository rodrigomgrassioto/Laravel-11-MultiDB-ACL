<?php

use App\Http\Controllers\BouthSystem\Auth\AuthController;
use App\Http\Controllers\CentralSystem\TenantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // public
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->middleware('auth:sanctum');

        Route::post('new_tenant', [TenantController::class, 'store']);
        Route::post('my_login', [AuthController::class, 'login']);

        // public end

        ###############

        // auth
        // criar grupo auth aqui
        // auth end
    });
}
