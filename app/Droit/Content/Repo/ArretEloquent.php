<?php namespace Droit\Content\Repo;

use Droit\Content\Repo\ArretInterface;
use Droit\Content\Entities\Arret as M;

class ArretEloquent implements ArretInterface{

	protected $arret;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(M $arret)
	{
		$this->arret = $arret;
	}

    public function getAll($pid){

        return $this->arret
            ->with( array('arrets_categories' => function ($query)
            {
                $query->orderBy('sorting', 'ASC');
            },'arrets_analyses' => function($query)
            {
                $query->where('analyses.deleted', '=', 0);
            }))
            ->orderBy('reference', 'ASC')->get();
    }

    public function getPaginate($pid,$nbr){

        return $this->arret->with( array('arrets_categories' => function ($query)
        {
            $query->orderBy('sorting', 'ASC');
        },'arrets_analyses' => function($query)
        {
            $query->where('analyses.deleted', '=', 0);

        }))->orderBy('pub_date', 'DESC')->paginate($nbr);
    }

    public function getLatest(){

        $arrets = $this->arret->with( array('arrets_analyses' => function($query)
            {
                $query->where('analyses.deleted', '=', 0);
            }))->orderBy('id', 'ASC')->get();

        $new = $arrets->filter(function($item)
        {
            if (!$item->arrets_analyses->isEmpty()) {
                return true;
            }
        });

        return $new->take(5);

    }

	public function find($id){

        if(is_array($id))
        {
            return $this->arret->whereIn('id', $id)->with(array('arrets_categories'=> function ($query)
                {
                    $query->orderBy('sorting', 'ASC');
                },'arrets_analyses'))->get();
        }

		return $this->arret->where('id', '=' ,$id)->with(array('arrets_categories','arrets_analyses'))->get()->first();
	}

    public function findyByImage($file){

        return $this->arret->where('file','=',$file)->get();
    }

	public function create(array $data){

		$arret = $this->arret->create(array(
			'pid'        => $data['pid'],
			'user_id'    => $data['user_id'],
            'reference'  => $data['reference'],
            'pub_date'   => $data['pub_date'],
            'abstract'   => $data['abstract'],
            'pub_text'   => $data['pub_text'],
            'categories' => $data['categories'],
            'file'       => $data['file'],
            'dumois'     => $data['dumois'],
			'created_at' => date('Y-m-d G:i:s'),
			'updated_at' => date('Y-m-d G:i:s')
		));

		if( ! $arret )
		{
			return false;
		}

        // Flush cache
        \Cache::forget('arrets');
        \Cache::forget('annees');
		
		return $arret;
		
	}
	
	public function update(array $data){

        $arret = $this->arret->findOrFail($data['id']);
		
		if( ! $arret )
		{
			return false;
		}

        $arret->reference  = $data['reference'];
        $arret->pub_date   = $data['pub_date'];
        $arret->abstract   = $data['abstract'];
        $arret->pub_text   = $data['pub_text'];
        $arret->categories = $data['categories'];
        $arret->dumois     = $data['dumois'];

        if($data['file']){
            $arret->file = $data['file'];
        }

		$arret->updated_at = date('Y-m-d G:i:s');

		$arret->save();

        // Flush cache
        \Cache::forget('arrets');
        \Cache::forget('annees');
		
		return $arret;
	}

	public function delete($id){

        $arret = $this->arret->find($id);

        // Flush cache
        \Cache::forget('arrets');
        \Cache::forget('annees');

		return $arret->delete();
		
	}

}
