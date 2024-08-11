<?php

namespace App\Http\Middleware;

use App\Models\BouthSystem\Auth\Resource;
use Closure;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ResourceAuthorization
{
    use AuthorizesRequests;


    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ignore = config('ignore-acl')['ignore'];

        // Verifica se o nome da rota está na lista de ignorados
        if (!in_array($request->route()->getName() , $ignore)) {
            $user =  Auth::user();
            if (!$user) abort(403, 'Não logado');

            // Carrega todas permissões existentes no banco de dados e compara via gate
            $this->defineGates();

            // Autoriza o acesso
            $this->myAuthorize($request->route()->getName());

        }
        return $next($request);
    }

    public function defineGates()
    {
        $resources = Resource::all();

        foreach ($resources as $resource) {
//            dd($resource->resource == )
            Gate::define($resource->resource, function ($user) use ($resource) {
                return $resource->roles->contains($user->role);
            });
        }
    }

    public function myAuthorize($routeName)
    {
        $this->authorize($routeName);
    }
}
