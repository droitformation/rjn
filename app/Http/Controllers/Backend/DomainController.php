<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDomain;

use App\Droit\Domain\Repo\DomainInterface;
use App\Droit\Rjn\Repo\RjnInterface;

class DomainController extends Controller {

    protected $domain;
    protected $rjn;

    public function __construct(DomainInterface $domain, RjnInterface $rjn)
    {
        $this->rjn    = $rjn;
        $this->domain = $domain;
        $droit = [ 1 => 'Droit fédéral',  2 => 'Droit cantonal', 3 => 'Droit international'];
        \View::share('droit', $droit);
    }

	/**
	 *
	 * @return Response
	 */
	public function index()
	{
        $domains = $this->domain->getAll();

        return view('admin.domains.index')->with(array('domains' => $domains));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.domains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateDomain $request)
    {
        $domain = $this->domain->create($request->all());

        return redirect('admin/domain/'.$domain->id);
    }

    /**
     *
     * @return Response
     */
    public function show($id)
    {
        $domain = $this->domain->find($id);

        return view('admin.domains.show')->with(array('domain' => $domain));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,CreateDomain $request)
    {
        $domain = $this->domain->update($request->all());

        return redirect('admin/domain/'.$domain->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->domain->delete($id);

        return redirect('admin/domain')->with(array('status' => 'success', 'message' => 'Domaine supprimé' ));
    }

}
