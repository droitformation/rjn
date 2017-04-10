<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use  App\Http\Requests\CreateArret;

use App\Droit\Domain\Repo\DomainInterface;
use App\Droit\Arret\Repo\ArretInterface;
use App\Droit\Critique\Repo\CritiqueInterface;
use App\Droit\Categorie\Repo\CategorieInterface;
use App\Droit\Groupe\Repo\GroupeInterface;
use App\Droit\Rjn\Repo\RjnInterface;

class ArretController extends Controller {

    protected $domain;
    protected $categorie;
    protected $arret;
    protected $critique;
    protected $rjn;
    protected $groupe;
    protected $dropdown;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DomainInterface $domain, ArretInterface $arret, CategorieInterface $categorie,GroupeInterface $groupe, CritiqueInterface $critique, RjnInterface $rjn)
    {
        $this->arret     = $arret;
        $this->groupe    = $groupe;
        $this->critique  = $critique;
        $this->rjn       = $rjn;
        $this->categorie = $categorie;
        $this->domain    = $domain;

        $volumes  = $this->rjn->getAll()->pluck('volume','id')->all();
        $domains  = $this->domain->getAll(2)->pluck('title','id')->all();

        \View::share('domains', $domains);
        \View::share('rjn', $volumes);
        \View::share('pageTitle', 'Arrêts');

    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $arrets = $this->arret->getAll(1);

        return view('admin.arrets.index')->with(array( 'arrets' => $arrets ));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $groupes = $this->groupe->getAll();

        return view('admin.arrets.create')->with(['groupes' => $groupes]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param  $request
	 * @return Response
	 */
	public function store(CreateArret $request)
	{
        $arret = $this->arret->create($request->all());
		
		

        return redirect('admin/arret/'.$arret->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $arret    = $this->arret->find($id);
        $critique = $this->critique->getByType('arret',$id);
        $groupes  = $this->groupe->getAll();

        return view('admin.arrets.show')->with(array( 'arret' => $arret, 'critique' => $critique ,'groupes' => $groupes));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function arrets()
	{
		return $this->arret->getAll(1)->pluck('designation','id')->all();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,CreateArret $request)
	{

        $arret = $this->arret->update($request->all());

        return redirect('admin/arret/'.$arret->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->arret->delete($id);

        return redirect('admin/arret')->with(array('status' => 'success', 'message' => 'Arrêt supprimé' ));
	}

}
