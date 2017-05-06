<?php

namespace Yk\LaravelInstaller\App\Http\Middleware;

use Closure;

class MiddlewareTrigger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\File::exists(base_path('.env'))) {
            if ($request->getRequestUri() === '/install') {
                return redirect('/');
            }    
        }else{
            if ($request->getRequestUri() !== '/install') {
                return redirect(route('install.index'));
            }
        }

        return $next($request);
    }

    public function terminate($request, $response)
    {
        
    }

}