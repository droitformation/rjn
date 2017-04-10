<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Requests\CreateArticle;

use App\Http\Controllers\Controller;
use App\Droit\Domain\Worker\DomainWorker;
use App\Droit\Rjn\Repo\RjnInterface;
use App\Droit\Doctrine\Repo\DoctrineInterface;
use App\Droit\Author\Repo\AuthorInterface;

use Illuminate\Http\Request;

class ArticleController extends Controller {

    protected $domain;
    protected $doctrine;
    protected $author;
    protected $rjn;
    protected $dropdown;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DomainWorker $domain, DoctrineInterface $doctrine, AuthorInterface $author, RjnInterface $rjn)
    {
        $this->doctrine  = $doctrine;
        $this->rjn       = $rjn;
        $this->domain    = $domain;
        $this->author    = $author;

        $volumes  = $this->rjn->getAll()->pluck('volume','id')->all();
        $authors  = $this->author->getAll()->pluck('name','id')->all();
        $dropdown = $this->domain->domainDropdown();

        \View::share('pageTitle', 'Articles de doctrine');
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
        $articles = $this->doctrine->getAll(1);

        return view('admin.articles.index')->with(array( 'articles' => $articles ));
	}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function articles()
    {
        return $this->doctrine->getAll(1)->pluck('titre','id')->all();
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.articles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateArticle $request)
	{
        $article = $this->doctrine->create($request->all());

        return redirect('admin/article/'.$article->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $article = $this->doctrine->find($id);

        return view('admin.articles.show')->with(array( 'article' => $article ));
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
	public function update($id,CreateArticle $request)
	{
        $article = $this->doctrine->update($request->all());

        return redirect('admin/article/'.$article->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->doctrine->delete($id);

        return redirect('admin/article')->with(array('status' => 'success', 'message' => 'Article supprimé' ));
	}

}
