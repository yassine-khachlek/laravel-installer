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

        $response = $next($request);

        /*
        // Forbidden install when .env exist
        if ($request->getRequestUri() === '/install')
            if(\File::exists(base_path('.env')))
                $response->setContent(view('Yk\LaravelInstaller::install.forbidden'));
        */

        // Redirect to the install script when .env is missing
        if ($request->getRequestUri() !== '/install')
            if(!\File::exists(base_path('.env')))
                $response->setContent(view('Yk\LaravelInstaller::install.redirect'));

        return $response;
        
    }


}