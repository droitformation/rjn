<?php namespace App\Droit\Chronique\Repo;

use App\Droit\Chronique\Repo\ChroniqueInterface;
use App\Droit\Chronique\Entities\Chronique as M;

class ChroniqueEloquent implements ChroniqueInterface{

	protected $chronique;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(M $chronique)
	{
		$this->chronique = $chronique;
	}

    public function getAll($pid){

        return $this->chronique->where('pid','=',$pid)->with( array('chronique_citations','author_chronique'))->get();
    }

    public function getByVolume($volume_id){

        return $this->chronique->where('volume_id','=',$volume_id)->get();
    }

    public function searchAgainst($terms)
    {
        return $this->chronique->whereRaw(
            "MATCH(titre,faits,commentaires,commentaires) AGAINST(? IN BOOLEAN MODE)", array($terms)
        )->get();
    }

    public function searchSimple($term)
    {
        return $this->chronique
            ->where('titre', 'LIKE', '%'.$term.'%')
            ->orWhere('faits', 'LIKE', '%'.$term.'%')
            ->orWhere('commentaires', 'LIKE', '%'.$term.'%')
            ->orWhere('commentaires', 'LIKE', '%'.$term.'%')
            ->get();
    }

    public function find($id){

        if(is_array($id))
        {
            return $this->chronique->whereIn('id', $id)->with(array('chronique_citations','author_chronique'))->get();
        }

		return $this->chronique->where('id', '=' ,$id)->with(array('chronique_citations','author_chronique'))->get()->first();
	}

	public function create(array $data){

		$chronique = $this->chronique->create(array(
            'pid'          => $data['pid'],
            'domain_id'    => $data['domain_id'],
            'sorting'      => $data['sorting'],
            'volume_id'    => $data['volume_id'],
            'page'         => $data['page'],
            'pub_date'     => $data['pub_date'],
            'titre'        => $data['titre'],
            'faits'        => $data['faits'],
            'commentaires' => (isset($data['commentaires']) ? $data['commentaires'] : ''),
            'citations'    => (isset($data['citations']) ? $data['citations'] : ''),
			'created_at'   => date('Y-m-d G:i:s'),
			'updated_at'   => date('Y-m-d G:i:s')
		));

		if( ! $chronique )
		{
			return false;
		}

        $chronique->author_chronique()->attach($data['author_id']);

		return $chronique;
		
	}
	
	public function update(array $data){

        $chronique = $this->chronique->findOrFail($data['id']);
		
		if( ! $chronique )
		{
			return false;
		}

        $chronique->fill($data);
		$chronique->updated_at = date('Y-m-d G:i:s');
		$chronique->save();

        $chronique->author_chronique()->sync($data['author_id']);
		
		return $chronique;
	}

	public function delete($id){

        $chronique = $this->chronique->find($id);

		return $chronique->delete($id);
		
	}

}
