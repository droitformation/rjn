<?php namespace App\Droit\Loi\Repo;

use App\Droit\Loi\Repo\LoiInterface;
use App\Droit\Loi\Entities\Loi as M;

class LoiEloquent implements LoiInterface{

    protected $loi;

    public function __construct(M $loi)
    {
        $this->loi = $loi;
    }

    public function getAll(){

        return $this->loi->with(array('dispositions'))->orderBy('sigle', 'ASC')->get();
    }

    public function search($terms)
    {
        return $this->loi->where('name','LIKE','%'.$terms.'%')->orWhere('sigle','LIKE','%'.$terms.'%')->orderBy('name', 'ASC')->get();
    }

    public function searchAgainst($terms)
    {
        return $this->loi->whereHas('dispositions', function($q) use ($terms)
        {
            $q->whereRaw("MATCH(content) AGAINST(? IN BOOLEAN MODE)", array($terms) );

        })->orderBy('title', 'ASC')->get();
    }

    public function searchSimple($term)
    {
        return $this->loi->with(array('dispositions'))
            ->where('name', 'LIKE', '%'.$term.'%')
            ->orWhere('sigle', 'LIKE', '%'.$term.'%')
            ->orWhere(function($query) use ($term)
            {
                $query->whereHas('dispositions', function ($subquery) use ( $term ){
                    $subquery->where('content','LIKE','%'.$term.'%' );
                });

            })->orderBy('sigle', 'ASC')->get();
    }

    public function find($id){

        return $this->loi->with(array('dispositions' => function($query)
            {
                $query->orderBy('cote', 'ASC');

            }))->findOrFail($id);
    }

    public function findSigle($id){

        return $this->loi->where('id','=',$id)->get(['sigle'])->first();
    }

    public function create(array $data){

        $loi = $this->loi->create(array(
            'name'  => $data['name'],
            'sigle' => $data['sigle'],
            'droit' => $data['droit']
        ));

        if( ! $loi )
        {
            return false;
        }

        return $loi;

    }

    public function update(array $data){

        $loi = $this->loi->findOrFail($data['id']);

        if( ! $loi )
        {
            return false;
        }

        $loi->name  = $data['name'];
        $loi->sigle = $data['sigle'];
        $loi->droit = $data['droit'];

        $loi->save();

        return $loi;
    }

    public function delete($id){

        $loi = $this->loi->find($id);

        return $loi->delete();
    }

}
