<?php namespace App\Droit\Critique\Repo;

use App\Droit\Critique\Repo\CritiqueInterface;
use App\Droit\Critique\Entities\Critique as M;

class CritiqueEloquent implements CritiqueInterface{

    protected $critique;

    public function __construct(M $critique)
    {
        $this->critique = $critique;
    }

    public function getAll(){

        return $this->critique->all();
    }

    public function find($id){

        return $this->critique->findOrFail($id);
    }

    public function getByType($type, $id = null){

        $critique = $this->critique->where('type', '=' ,$type);

        if($id)
        {
            $critique->where('item_id', '=' ,$id);
        }

        return $critique->get();
    }

    public function create(array $data){

        $critique = $this->critique->create(array(
            'type'      => $data['type'],
            'item_id'   => $data['item_id'],
            'author_id' => $data['author_id'],
            'titre'     => $data['titre'],
            'contenu'   => $data['contenu']
        ));

        if( ! $critique )
        {
            return false;
        }

        return $critique;

    }

    public function update(array $data){

        $critique = $this->critique->findOrFail($data['id']);

        if( ! $critique )
        {
            return false;
        }

        $critique->author_id = $data['author_id'];
        $critique->titre     = $data['titre'];
        $critique->contenu   = $data['contenu'];

        if(!empty($data['type']))
        {
            $critique->type = $data['type'];
        }

        if(!empty($data['item_id']))
        {
            $critique->item_id = $data['item_id'];
        }

        $critique->save();

        return $critique;
    }

    public function delete($id){

        $critique = $this->critique->find($id);

        return $critique->delete($id);
    }

}
