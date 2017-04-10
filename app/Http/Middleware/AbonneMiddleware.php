<?php

namespace App\Http\Middleware;

use Closure;
use App\Droit\Code\Worker\CodeWorkerInterface;

class AbonneMiddleware
{
    protected $code;

    public function __construct(CodeWorkerInterface $code)
    {
        $this->code = $code;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if((\Auth::user()->role == 'admin' || \Auth::user()->role == 'invite'))
        {
            return $next($request);
        }

        if(!$this->code->active(\Auth::user()->id))
        {
            return redirect('auth/activate')->with(['status' => 'warning', 'message' => 'Votre compte sur rjne.ch n\'est plus valable.']);
        }

        return $next($request);
    }
}
