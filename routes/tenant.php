<?php

declare(strict_types=1);

use App\Http\Controllers\BouthSystem\Auth\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id').
            ' users: '. User::all()
            ;
    });
});

Route::middleware([
    'api',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,

])->prefix('api')->group(function () {

    // auth
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        // apenas logado
        // outras rota

        // acl
        Route::middleware(['ResouceAuthorization.Auth'])->group(function () {
            Route::get('tstmid-ten', function () { dd('Aprovado tenant');})->name('tstmid.ten');
        }); // acl fim
    });// auth end

    // api public
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id').
            ' users: '. User::all()
            ;
    });
    Route::post('my_login', [AuthController::class, 'login']);
    // api public fim
});
