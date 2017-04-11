<?php
namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use  App\Http\Requests\CreateMatiere;

use App\Http\Controllers\Controller;
use App\Droit\Rjn\Repo\RjnInterface;
use App\Droit\Matiere\Repo\MatiereInterface;

use Illuminate\Http\Request;

class MatiereController extends Controller {

    protected $matiere;
    protected $rjn;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MatiereInterface $matiere, RjnInterface $rjn)
    {
        $this->matiere  = $matiere;
        $this->rjn       = $rjn;

        $volumes  = $this->rjn->getAll()->pluck('volume','id')->all();

        \View::share('pageTitle', 'Matieres');
        \View::share('rjn', $volumes);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $matieres = $this->matiere->getAll();

        return view('admin.matieres.index')->with(array( 'matieres' => $matieres ));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.matieres.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateMatiere $request)
	{
        $matiere = $this->matiere->create($request->all());

		if($request->ajax()){
			$matieres = $this->matiere->getAll()->sortBy('title');
			$matieres = $matieres->map(function ($matiere, $key) {
				return [
					'label' => $matiere->title,
					'value' => $matiere->id,
				];
			});

			return ['matieres' => $matieres];
		}

        return redirect('admin/matiere/'.$matiere->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $matiere = $this->matiere->find($id);

        return view('admin.matieres.show')->with(array( 'matiere' => $matiere ));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,CreateMatiere $request)
	{
        $matiere = $this->matiere->update($request->all());

        return redirect('admin/matiere/'.$matiere->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->matiere->delete($id);

        return redirect('admin/matiere')->with(array('status' => 'success', 'message' => 'Matière supprimé' ));
	}

}
