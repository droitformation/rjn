<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use  App\Http\Requests\CreateGroupe;

use App\Droit\Domain\Repo\DomainInterface;
use App\Droit\Groupe\Repo\GroupeInterface;
use App\Droit\Categorie\Repo\CategorieInterface;
use App\Droit\Rjn\Repo\RjnInterface;

use Illuminate\Http\Request;

class GroupeController extends Controller {

    protected $domain;
    protected $categorie;
    protected $groupe;
    protected $rjn;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DomainInterface $domain, GroupeInterface $groupe, CategorieInterface $categorie , RjnInterface $rjn)
    {

        $this->groupe    = $groupe;
        $this->rjn       = $rjn;
        $this->categorie = $categorie;
        $this->domain    = $domain;

        $volumes  = $this->rjn->getAll()->pluck('volume','id')->all();
        $domains  = $this->domain->getAll(2)->pluck('title','id')->all();

        \View::share('domains', $domains);
        \View::share('rjn', $volumes);
        \View::share('pageTitle', 'Groupes');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $groupes = $this->groupe->getAll();

        return view('admin.groupes.index')->with(array( 'groupes' => $groupes ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.groupes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return Response
     */
    public function store(CreateGroupe $request)
    {

        $groupe = $this->groupe->create($request->all());

        return redirect('admin/groupe/'.$groupe->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $groupe = $this->groupe->find($id);

        return view('admin.groupes.show')->with(array( 'groupe' => $groupe ));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,CreateGroupe $request)
    {

        $groupe = $this->groupe->update($request->all());

        return redirect('admin/groupe/'.$groupe->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->groupe->delete($id);

        return redirect('admin/groupe')->with(array('status' => 'success', 'message' => 'Groupe supprimé' ));
    }

}
