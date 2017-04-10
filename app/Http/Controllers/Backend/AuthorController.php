<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use  App\Http\Requests\CreateAuthor;
use App\Droit\Author\Repo\AuthorInterface;

use Illuminate\Http\Request;

class AuthorController extends Controller {

    protected $author;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorInterface $author)
    {
        $this->author = $author;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $authors = $this->author->getAll();

        return view('admin.authors.index')->with(array( 'authors' => $authors ));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.authors.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateAuthor $request)
	{
        $author = $this->author->create($request->all());

        return redirect('admin/author/'.$author->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $author = $this->author->find($id);

        return view('admin.authors.show')->with(array( 'author' => $author ));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,CreateAuthor $request)
	{
        $author = $this->author->update($request->all());

        return redirect('admin/author/'.$author->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->author->delete($id);

        return redirect('admin/author')->with(array('status' => 'success', 'message' => 'Auteur supprimé' ));
	}

}
