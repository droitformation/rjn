<?php namespace App\Droit\Categorie\Repo;

use App\Droit\Categorie\Repo\CategorieInterface;
use App\Droit\Categorie\Entities\Categorie as M;

class CategorieEloquent implements CategorieInterface{

    protected $categorie;

    public function __construct(M $categorie)
    {
        $this->categorie = $categorie;
    }

    public function getAll($pid){

        return $this->categorie->where('pid','=',$pid)->where('deleted', '=', 0)->orderBy('title', 'ASC')->get();
    }

    public function find($id){

        return $this->categorie->findOrFail($id);
    }

    public function create(array $data){

        $categorie = $this->categorie->create(array(
            'pid'        => $data['pid'],
            'domain_id'  => $data['domain_id'],
            'title'      => $data['title'],
            'image'      => (isset($data['image']) && !empty($data['image']) ? $data['image'] : ''),
            'created_at' => date('Y-m-d G:i:s'),
            'updated_at' => date('Y-m-d G:i:s')
        ));

        if( ! $categorie )
        {
            return false;
        }

        return $categorie;

    }

    public function update(array $data){

        $categorie = $this->categorie->findOrFail($data['id']);

        if( ! $categorie )
        {
            return false;
        }

        $categorie->fill($data);

        $categorie->updated_at = date('Y-m-d G:i:s');
        $categorie->save();

        return $categorie;
    }

    public function delete($id){

        $categorie = $this->categorie->find($id);

        return $categorie->delete();

    }

}
