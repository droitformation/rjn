<?php namespace App\Http\Middleware;

use Closure;

class ArretMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $type = $request->segment(1);

        $request->merge(compact('type'));

		return $next($request);
	}

}
