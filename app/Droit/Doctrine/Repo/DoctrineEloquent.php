<?php namespace App\Droit\Doctrine\Repo;

use App\Droit\Doctrine\Repo\DoctrineInterface;
use App\Droit\Doctrine\Entities\Doctrine as Doctrine;
use App\Droit\Doctrine\Entities\Doctrine_citations as Doctrine_citations;

class DoctrineEloquent implements DoctrineInterface{

	protected $doctrine;
    protected $citations;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(Doctrine $doctrine)
	{
		$this->doctrine  = $doctrine;
	}

    public function getAll($pid){

        return $this->doctrine->where('pid','=',$pid)->orderBy('volume_id', 'DESC')->get();
    }

    public function getByVolume($volume_id){

        return $this->doctrine->where('volume_id','=',$volume_id)->get();
    }

    public function searchAgainst($terms)
    {
        return $this->doctrine->whereRaw(
            "MATCH(titre,article,bibliographie,notes,citations) AGAINST(? IN BOOLEAN MODE)", array($terms)
        )->get();
    }

    public function searchSimple($term)
    {
        return $this->doctrine
            ->where('titre', 'LIKE', '%'.$term.'%')
            ->orWhere('article', 'LIKE', '%'.$term.'%')
            ->orWhere('bibliographie', 'LIKE', '%'.$term.'%')
            ->orWhere('notes', 'LIKE', '%'.$term.'%')
            ->orWhere('citations', 'LIKE', '%'.$term.'%')
            ->get();
    }

    public function find($id){

        if(is_array($id))
        {
            return $this->doctrine->whereIn('id', $id)->with(array('doctrine_citations','doctrine_author'))->get();
        }

		return $this->doctrine->where('id', '=' ,$id)->with(array('doctrine_citations','doctrine_author'))->get()->first();
	}

	public function create(array $data){

		$doctrine = $this->doctrine->create(array(
            'pid'           => $data['pid'],
            'titre'         => $data['titre'],
            'volume_id'     => $data['volume_id'],
            'domain_id'     => $data['domain_id'],
            'page'          => $data['page'],
            'pub_date'      => $data['pub_date'],
            'article'       => $data['article'],
            'bibliographie' => (isset($data['bibliographie']) ? $data['bibliographie'] : ''),
            'notes'         => (isset($data['notes']) ? $data['notes'] : ''),
            'citations'     => (isset($data['citations']) ? $data['citations'] : ''),
			'created_at'    => date('Y-m-d G:i:s'),
			'updated_at'    => date('Y-m-d G:i:s')
		));

		if( ! $doctrine )
		{
			return false;
		}

        $doctrine->doctrine_author()->attach($data['author_id']);

		return $doctrine;
		
	}
	
	public function update(array $data){

        $doctrine = $this->doctrine->findOrFail($data['id']);
		
		if( ! $doctrine )
		{
			return false;
		}

        $doctrine->fill($data);
		$doctrine->updated_at = date('Y-m-d G:i:s');
		$doctrine->save();

        $doctrine->doctrine_author()->sync($data['author_id']);
		
		return $doctrine;
	}

	public function delete($id){

        $doctrine = $this->doctrine->findOrFail($id);
        return $doctrine->delete($id);
		
	}

}
