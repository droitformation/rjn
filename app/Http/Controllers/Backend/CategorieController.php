<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use  App\Http\Requests\CreateCategorie;

use App\Http\Controllers\Controller;
use App\Droit\Categorie\Repo\CategorieInterface;
use App\Droit\Domain\Repo\DomainInterface;

use Illuminate\Http\Request;

class CategorieController extends Controller {

    protected $categorie;
    protected $domain;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DomainInterface $domain,CategorieInterface $categorie)
    {
        $this->categorie = $categorie;
        $this->domain    = $domain;

        $domains = $this->domain->getAll(2)->pluck('title','id')->all();
        \View::share('domains', $domains);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $categories = $this->categorie->getAll(1);

        return view('admin.categories.index')->with(array( 'categories' => $categories ));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateCategorie $request)
	{
        $categorie = $this->categorie->create($request->all());

        return redirect('admin/categorie/'.$categorie->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $categorie = $this->categorie->find($id);

        return view('admin.categories.show')->with(array( 'categorie' => $categorie ));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,CreateCategorie $request)
	{
        $categorie = $this->categorie->update($request->all());

        return redirect('admin/categorie/'.$categorie->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->categorie->delete($id);

        return redirect('admin/categorie')->with(array('status' => 'success', 'message' => 'Catégorie supprimé' ));
	}

    /**
     * lists the categories for domain
     *
     * @param  int  $id
     * @return Response
     */
    public function lists($id)
    {
        $domain     = $this->domain->find($id);
        $categories = (isset($domain->categories) ? $domain->categories->pluck('title','id'): [] );

        return \Response::json( $categories, 200 );
    }
}
