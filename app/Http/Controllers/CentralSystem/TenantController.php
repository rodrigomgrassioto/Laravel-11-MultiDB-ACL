<?php

namespace App\Http\Controllers\CentralSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\CentralSystem\TenantRequest;
use App\Models\CentralSystem\Tenant;
use Database\Seeders\TenantSystem\UserSeeder;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    public function store(TenantRequest $request)
    {
        $subdomainString = Str::slug($request['subdomain'],'_');

        if (!$tenant = Tenant::create(['subdomain' => $subdomainString]))
            return response()->json(['message' => 'Erro ao cadastrar inquilino'],402, [], JSON_UNESCAPED_UNICODE);
        if(!$domain = $tenant->createDomain(['domain' => $subdomainString]))
            return response()->json(['message' => 'Erro ao cadastrar subdominio'],402, [], JSON_UNESCAPED_UNICODE);

        $seeder = new UserSeeder();
        $tenant->run(function () use ($seeder){
            $seeder->run();
        });

        return response()->json([
            'message' => 'Inquilino cadastrado com sucesso!!!',
            'tenant' => $tenant,
            'domain' => $domain,
            ],200, [], JSON_UNESCAPED_UNICODE);
    }
}
