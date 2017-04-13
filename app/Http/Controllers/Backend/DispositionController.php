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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeAjax(CreateDisposition $request)
    {
        $data_disposition = $request->only(['loi_id','volume_id','page','article']);
        $data_page = $request->only(['volume_id','page','alinea','chiffre','lettre']);

        $this->validate($request, [
            'loi_id'    => 'required',
            'page'      => 'required',
            'volume_id' => 'required',
            'article'   => 'required',
        ]);

        $disposition = $this->disposition->create([
            'loi_id'    => $data_disposition['loi_id'],
            'content'   => "",
            'volume_id' => $data_disposition['volume_id'],
            'page'      => $data_disposition['page'],
            'cote'      => $data_disposition['article'],
        ]);

        $page = new \App\Droit\Disposition\Entities\Disposition_page($data_page);

        $disposition->disposition_pages()->save($page);

        $dispositions = $this->disposition->getVolumePage($request->input('volume_id'),$request->input('page'));
        $dispositions = !$dispositions->isEmpty() ? $dispositions->map(function ($disposition, $key) {
            return $disposition->disposition_pages->map(function ($dis, $key) use ($disposition) {
                return [
                    'id'      => $disposition->id,
                    'loi'     => $disposition->loi->title,
                    'loi_id'  => $disposition->loi_id,
                    'article' => 'Art. '.$disposition->cote_number,
                    'alinea'  => !empty($dis->alinea) ? 'al. '.$dis->alinea : "",
                    'chiffre' => !empty($dis->chiffre) ? 'ch. '.$dis->chiffre : "",
                    'lettre'  => !empty($dis->lettre) ? 'let. '.$dis->lettre : "",
                ];
            });
        })->flatten(1) : collect([]);

        return ['dispositions' => $dispositions];
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
    public function destroy($id,Request $request)
    {
        $oldDis = $this->disposition->find($id);
        $loi_id = $oldDis->loi_id;
        $this->disposition->delete($id);
        
        if($request->ajax()){
            $dispositions = $this->disposition->getVolumePage($oldDis->volume_id,$oldDis->page);
            $dispositions = !$dispositions->isEmpty() ? $dispositions->map(function ($disposition, $key) {
                return $disposition->disposition_pages->map(function ($dis, $key) use ($disposition) {
                    return [
                        'id'      => $disposition->id,
                        'loi'     => $disposition->loi->title,
                        'loi_id'  => $disposition->loi_id,
                        'article' => 'Art. '.$disposition->cote_number,
                        'alinea'  => !empty($dis->alinea) ? 'al. '.$dis->alinea : "",
                        'chiffre' => !empty($dis->chiffre) ? 'ch. '.$dis->chiffre : "",
                        'lettre'  => !empty($dis->lettre) ? 'let. '.$dis->lettre : "",
                    ];
                });
            })->flatten(1) : collect([]);

            return ['dispositions' => $dispositions];
        }

        return redirect('admin/disposition/loi/'.$loi_id)->with(array('status' => 'success', 'message' => 'Disposition supprimé' ));
    }

}
