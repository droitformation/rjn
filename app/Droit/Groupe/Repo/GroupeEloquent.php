<?php namespace App\Droit\Groupe\Repo;

use App\Droit\Groupe\Repo\GroupeInterface;
use App\Droit\Groupe\Entities\Groupe as M;

class GroupeEloquent implements GroupeInterface{

	protected $groupe;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(M $groupe)
	{
		$this->groupe = $groupe;
	}

    public function getAll(){

        return $this->groupe->with(array('arret_groupes'))->get();
    }

	public function find($id){
				
		return $this->groupe->with(array('arret_groupes'))->find($id);
	}

	public function create(array $data){

		$groupe = $this->groupe->create(array(
			'titre'        => $data['titre'],
            'domain_id'    => $data['domain_id'],
            'categorie_id' => $data['categorie_id'],
            'volume_id'    => $data['volume_id']
		));

		if( ! $groupe )
		{
			return false;
		}
		
		return $groupe;
		
	}
	
	public function update(array $data){

        $groupe = $this->groupe->findOrFail($data['id']);
		
		if( ! $groupe )
		{
			return false;
		}

        $groupe->fill($data);

		$groupe->save();
		
		return $groupe;
	}

	public function delete($id){

        $groupe = $this->groupe->find($id);

		return $groupe->delete($id);
		
	}

}
