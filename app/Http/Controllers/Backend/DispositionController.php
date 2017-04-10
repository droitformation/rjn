<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Requests\CreateDisposition;
use App\Http\Requests\AddPageRequest;

use App\Http\Controllers\Controller;
use App\Droit\Disposition\Repo\DispositionInterface;
use App\Droit\Loi\Repo\LoiInterface;
use App\Droit\Rjn\Repo\RjnInterface;

use Illuminate\Http\Request;

class DispositionController extends Controller {

    protected $disposition;
    protected $loi;
    protected $rjn;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DispositionInterface $disposition,LoiInterface $loi,RjnInterface $rjn)
    {
 
        $this->helper      = new \App\Droit\Helper\Helper;
        $this->disposition = $disposition;
        $this->loi         = $loi;
        $this->rjn         = $rjn;

        \View::share('rjn', $this->rjn->getAll()->pluck('volume','id'))->all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $dispositions = $this->disposition->getAll();

        return view('admin.dispositions.index')->with(array( 'dispositions' => $dispositions ));
    }

    /**
     * Display a listing of the resource for matiere.
     *
     * @param  int  $id
     * @return Response
     */
    public function loi($id)
    {
        $dispositions = $this->loi->find($id);

        return view('admin.dispositions.index')->with(array( 'dispositions' => $dispositions , 'loi_id' => $id));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($loi_id)
    {
        return view('admin.dispositions.create')->with(array('loi_id' => $loi_id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateDisposition $request)
    {
        $loi = $this->disposition->create($request->all());

        return redirect('admin/disposition/'.$loi->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $disposition = $this->disposition->find($id);

        return view('admin.dispositions.show')->with(array( 'disposition' => $disposition ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function page($id)
    {
        $disposition = $this->disposition->find($id);

        return view('admin.dispositions.page')->with(array( 'disposition' => $disposition ));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function addpage(Request $request)
    {
        $pages       = $this->helper->convertDispositionPages($request->all());
        $disposition = $this->disposition->find($request->input('id'));

        if(!empty($pages))
        {
            foreach($pages as $page)
            {
                $new[] = new \App\Droit\Disposition\Entities\Disposition_page($page);
            }
        }

        $disposition->disposition_pages()->delete();

        if(isset($new)){
            $disposition->disposition_pages()->saveMany($new);
        }

        return redirect('admin/disposition/page/'.$disposition->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,CreateDisposition $request)
    {
        $loi = $this->disposition->update($request->all());

        return redirect('admin/disposition/'.$loi->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $loi_id = $this->disposition->find($id)->loi_id;
        $this->disposition->delete($id);

        return redirect('admin/disposition/loi/'.$loi_id)->with(array('status' => 'success', 'message' => 'Disposition supprimé' ));
    }

}
