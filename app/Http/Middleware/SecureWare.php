<?php

namespace App\Http\Middleware;

use App\Services\Utility\AchieveLogger;
use Illuminate\Support\Facades\Session;

use Closure;

class SecureWare
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
        // grab the path
        $path = $request->path();
        
        AchieveLogger::info("Entering SecureWare in handle() at path" . $path);
        // Create variable for security check
        $secureCheck = true;
        // create business rules that check all of the URI's
        if($request->is('/') || $request->is('register') || $request->is('login') || $request->is('processLogin') || $request->is('logout'))
        {
            $secureCheck = false;
        }
        // log what does or doesn't need security handling
        AchieveLogger::info($secureCheck ? "Security Middleware in handle()... Needs Security" : "Security Middleware in handle()... no security required");
        
        // if secure check is true
        if($secureCheck && Session::get('users') == null)
        {
            // redirect to login3
            dd(session()->all());
            AchieveLogger::info("Leaving SecureWare in handle() doing a redirect back to login");
            return redirect('/login');
        }
        
        
        
        
        return $next($request);
    }
}
