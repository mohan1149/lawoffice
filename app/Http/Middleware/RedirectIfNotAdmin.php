<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use App;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'admin')
	{
		$locale = config('app.locale');
        if ($request->session()->has('user.language')) {
            $locale = $request->session()->get('user.language');
        }
        App::setLocale($locale);
		
	    if (!Auth::guard($guard)->check()) {
	        return redirect('admin/login');
	    }

	    return $next($request);
	}
}