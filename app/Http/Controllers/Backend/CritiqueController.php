<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateCritique;
use App\Http\Requests\EditCritique;
use App\Droit\Critique\Repo\CritiqueInterface;
use App\Droit\Author\Repo\AuthorInterface;

use Illuminate\Http\Request;

class CritiqueController extends Controller {

    protected $critique;
    protected $author;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CritiqueInterface $critique, AuthorInterface $author)
    {
        $this->critique = $critique;
        $this->author   = $author;

        $authors  = $this->author->getAll()->pluck('name','id')->all();
        \View::share('authors', $authors);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $critiques = $this->critique->getAll();

        return view('admin.critiques.index')->with(array( 'critiques' => $critiques ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.critiques.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateCritique $request)
    {

        $critique = $this->critique->create($request->all());

        return redirect('admin/critique/'.$critique->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $critique = $this->critique->find($id);
        $critique = $critique->load([$critique->type]);

        return view('admin.critiques.show')->with(array( 'critique' => $critique ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,EditCritique $request)
    {

        $critique = $this->critique->update($request->all());

        return redirect('admin/critique/'.$critique->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->critique->delete($id);

        return redirect('admin/critique')->with(array('status' => 'success', 'message' => 'Critique supprimé' ));
    }

}
