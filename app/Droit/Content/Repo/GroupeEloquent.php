<?php namespace Droit\Content\Repo;

use Droit\Content\Repo\GroupeInterface;
use Droit\Content\Entities\Groupe as M;

class GroupeEloquent implements GroupeInterface{

	protected $groupe;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(M $groupe)
	{
		$this->groupe = $groupe;
	}

    public function getAll($pid){

        return $this->groupe->with(array('arrets_groupes'))->get();
    }

	public function find($id){
				
		return $this->groupe->where('id', '=' ,$id)->with(array('arrets_groupes'))->get()->first();
	}

	public function create(array $data){

		$groupe = $this->groupe->create(array(
			'categorie_id' => $data['categorie_id']
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

        $groupe->categorie_id = $data['categorie_id'];

		$groupe->save();
		
		return $groupe;
	}

	public function delete($id){

        $groupe = $this->groupe->find($id);

		return $groupe->delete();
		
	}

}
