<?php

// App\Http\Middleware\CheckLogin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
        if (!Session::get('logged_in')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
