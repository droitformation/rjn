<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use  App\Http\Requests\CreateArticle;
use  App\Http\Requests\CreateLoi;

use App\Http\Controllers\Controller;
use App\Droit\Loi\Repo\LoiInterface;

use Illuminate\Http\Request;

class LoiController extends Controller {

    protected $loi;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoiInterface $loi)
    {
        $this->loi  = $loi;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $lois = $this->loi->getAll(1);

        return view('admin.lois.index')->with(array( 'lois' => $lois ));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.lois.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateLoi $request)
	{
        $loi = $this->loi->create($request->all());

		if($request->ajax()){
			$lois = $this->loi->getAll();
			$lois = $lois->map(function ($loi, $key) {
				return [
					'value' => $loi->id,
					'label' => $loi->title,
				];
			});

			return ['lois' => $lois];
		}

        return redirect('admin/loi/'.$loi->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $loi = $this->loi->find($id);

        return view('admin.lois.show')->with(array( 'loi' => $loi ));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
        $loi = $this->loi->update($request->all());

        return redirect('admin/loi/'.$loi->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->loi->delete($id);

        return redirect('admin/loi')->with(array('status' => 'success', 'message' => 'Loi supprimé' ));
	}
}
