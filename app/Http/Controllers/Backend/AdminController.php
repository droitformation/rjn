<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Droit\Arret\Repo\ArretInterface;
use App\Droit\Chronique\Repo\ChroniqueInterface;
use App\Droit\Doctrine\Repo\DoctrineInterface;
use App\Droit\Rjn\Repo\RjnInterface;

use Illuminate\Http\Request;

class AdminController extends Controller {

    protected $arret;
    protected $chronique;
    protected $doctrine;
    protected $rjn;

    public function __construct(ArretInterface $arret, ChroniqueInterface $chronique, DoctrineInterface $doctrine, RjnInterface $rjn )
    {
        $this->rjn        = $rjn;
        $this->arret      = $arret;
        $this->chronique  = $chronique;
        $this->doctrine   = $doctrine;

        $volumes  = $this->rjn->getAll()->pluck('volume','id')->all();
        \View::share('rjn', $volumes);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $arrets     = $this->arret->getAll(1)->take(5);
        $chroniques = $this->chronique->getAll(1)->take(5);
        $articles   = $this->doctrine->getAll(1)->take(5);

        return view('admin.index')->with([ 'arrets' => $arrets, 'chroniques' => $chroniques, 'articles' => $articles ]);
	}

}
