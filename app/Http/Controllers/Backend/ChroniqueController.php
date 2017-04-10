<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Requests\CreateChronique;

use App\Http\Controllers\Controller;
use App\Droit\Domain\Worker\DomainWorker;
use App\Droit\Rjn\Repo\RjnInterface;
use App\Droit\Chronique\Repo\ChroniqueInterface;
use App\Droit\Author\Repo\AuthorInterface;

use Illuminate\Http\Request;

class ChroniqueController extends Controller {

    protected $domain;
    protected $chronique;
    protected $author;
    protected $rjn;
    protected $dropdown;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DomainWorker $domain, ChroniqueInterface $chronique, AuthorInterface $author, RjnInterface $rjn)
    {
        $this->chronique  = $chronique;
        $this->rjn       = $rjn;
        $this->domain    = $domain;
        $this->author    = $author;

        $volumes  = $this->rjn->getAll()->pluck('volume','id')->all();
        $authors  = $this->author->getAll()->pluck('name','id')->all();
        $dropdown = $this->domain->domainDropdown();

        \View::share('pageTitle', 'Articles de chronique');
        \View::share('rjn', $volumes);
        \View::share('authors', $authors);
        \View::share('dropdown', $dropdown);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $chroniques = $this->chronique->getAll(1);

        return view('admin.chroniques.index')->with(array( 'chroniques' => $chroniques ));
	}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function chroniques()
    {
        return $this->chronique->getAll(1)->pluck('titre','id')->all();
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.chroniques.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateChronique $request)
	{
        $chronique = $this->chronique->create($request->all());

        return redirect('admin/chronique/'.$chronique->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $chronique = $this->chronique->find($id);

        return view('admin.chroniques.show')->with(array( 'chronique' => $chronique ));
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
	public function update($id,CreateChronique $request)
	{
        $chronique = $this->chronique->update($request->all());

        return redirect('admin/chronique/'.$chronique->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->chronique->delete($id);

        return redirect('admin/chronique')->with(array('status' => 'success', 'message' => 'Chronique supprimé' ));
	}

}
