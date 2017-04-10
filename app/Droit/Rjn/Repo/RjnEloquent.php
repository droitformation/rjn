<?php namespace App\Droit\Rjn\Repo;

use App\Droit\Rjn\Repo\RjnInterface;
use App\Droit\Rjn\Entities\Rjn as M;

class RjnEloquent implements RjnInterface{

    protected $rjn;

    public function __construct(M $rjn)
    {
        $this->rjn = $rjn;
    }

    public function getAll(){

        return $this->rjn->orderBy('publication_at', 'desc')->get();
    }

    public function find($id){

        return $this->rjn->findOrFail($id);
    }

    public function create(array $data){

        $rjn = $this->rjn->create(array(
            'title'          => $data['title'],
            'publication_at' => $data['publication_at'],
            'created_at'     => date('Y-m-d G:i:s'),
            'updated_at'     => date('Y-m-d G:i:s')
        ));

        if( ! $rjn )
        {
            return false;
        }

        return $rjn;

    }

    public function update(array $data){

        $rjn = $this->rjn->findOrFail($data['id']);

        if( ! $rjn )
        {
            return false;
        }

        $rjn->title          = $data['title'];
        $rjn->publication_at = $data['publication_at'];

        $rjn->save();

        return $rjn;
    }

    public function delete($id){

        $rjn = $this->rjn->find($id);

        return $rjn->delete();
    }

}
