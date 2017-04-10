<?php namespace App\Droit\Domain\Repo;

use App\Droit\Domain\Repo\DomainInterface;
use App\Droit\Domain\Entities\Domain as M;

class DomainEloquent implements DomainInterface{

    protected $domain;

    public function __construct(M $domain)
    {
        $this->domain = $domain;
    }

    public function getAll($droit = null){

        $domain =  $this->domain->with(array('categories'));

        if($droit)
        {
            $domain->where('droit','=',$droit);
        }

        return $domain->orderBy('droit', 'ASC')->orderBy('sorting', 'ASC')->get();
    }

    public function find($id){

        return $this->domain->with(array('categories'))->findOrFail($id);
    }

    public function create(array $data){

        $domain = $this->domain->create(array(
            'title'   => $data['title'],
            'droit'   => $data['droit'],
            'sorting' => $data['sorting']
        ));

        if( ! $domain )
        {
            return false;
        }

        return $domain;

    }

    public function update(array $data){

        $domain = $this->domain->findOrFail($data['id']);

        if( ! $domain )
        {
            return false;
        }

        $domain->fill($data);
        $domain->save();

        return $domain;
    }

    public function delete($id){

        $domain = $this->domain->find($id);

        return $domain->delete();
    }

}
