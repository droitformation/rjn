<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use  App\Http\Requests\CreateNote;

use App\Http\Controllers\Controller;
use App\Droit\Rjn\Repo\RjnInterface;
use App\Droit\Matiere\Repo\MatiereInterface;
use App\Droit\Matiere\Repo\MatiereNoteInterface;

use Illuminate\Http\Request;

class NoteController extends Controller {

    protected $matiere;
    protected $rjn;
    protected $note;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MatiereInterface $matiere, RjnInterface $rjn, MatiereNoteInterface $note)
    {
        $this->matiere  = $matiere;
        $this->rjn      = $rjn;
        $this->note     = $note;

        $volumes  = $this->rjn->getAll()->pluck('volume','id')->all();

        \View::share('pageTitle', 'Contenu des matières');
        \View::share('rjn', $volumes);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $notes = $this->matiere->getAll();

        return view('admin.notes.index')->with(array( 'notes' => $notes ));
	}

    /**
     * Display a listing of the resource for matiere.
     *
     * @param  int  $id
     * @return Response
     */
    public function matiere($id)
    {
        $notes = $this->matiere->find($id);

        return view('admin.notes.index')->with(array( 'notes' => $notes , 'matiere_id' => $id));
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($matiere_id)
	{
        return view('admin.notes.create')->with(array('matiere_id' => $matiere_id));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateNote $request)
	{
        $note = $this->note->create($request->all());

		if($request->ajax()){
			$notes = $this->note->getByVolumePage($note->volume_id,$note->page);
			$notes = !$notes->isEmpty() ? $notes->map(function ($note, $key) {
				return [
					'id' => $note->id,
					'content' => $note->content,
					'domaine' => $note->domaine,
					'confer_interne' => $note->confer_interne,
					'confer_externe' => $note->confer_externe,
					'matiere' => $note->matiere->title
				];
			}) : collect([]);

			return ['notes' => $notes];
		}

        return redirect('admin/note/'.$note->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $note = $this->note->find($id);

        return view('admin.notes.show')->with(array( 'note' => $note ));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,CreateNote $request)
	{
        $note = $this->note->update($request->all());

        return redirect('admin/note/'.$note->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		$oldnote    = $this->note->find($id);
        $matiere_id = $oldnote->matiere_id;
		
        $this->note->delete($id);

		if($request->ajax()){
			$notes = $this->note->getByVolumePage($oldnote->volume_id,$oldnote->page);
			$notes = !$notes->isEmpty() ? $notes->map(function ($note, $key) {
				return [
					'id' => $note->id,
					'content' => $note->content,
					'domaine' => $note->domaine,
					'confer_interne' => $note->confer_interne,
					'confer_externe' => $note->confer_externe,
					'matiere' => $note->matiere->title
				];
			}) : collect([]);

			return ['notes' => $notes];
		}

        return redirect('admin/note/matiere/'.$matiere_id)->with(array('status' => 'success', 'message' => 'Note supprimé' ));
	}

}
