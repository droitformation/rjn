<?php namespace App\Http\Middleware;

use Closure;
use App\Droit\Matiere\Repo\MatiereInterface;
use App\Droit\Loi\Repo\LoiInterface;

class SearchMiddleware {

    protected $matiere;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MatiereInterface $matiere, LoiInterface $loi)
    {
        $this->matiere = $matiere;
        $this->loi     = $loi;
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

        if ($request->input('matiere-id'))
        {
            $matiere = $this->matiere->find($request->input('matiere-id'));
            $alpha   = substr($matiere->title, 0, 1);

            return redirect('matiere/'.$alpha.'#'.$matiere->slug);
        }

        if ($request->input('loi-id'))
        {
            return redirect('disposition/'.$request->input('loi-id'));
        }

		return $next($request);
	}

}
