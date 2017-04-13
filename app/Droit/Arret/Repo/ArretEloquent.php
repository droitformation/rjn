<?php namespace App\Droit\Arret\Repo;

use App\Droit\Arret\Repo\ArretInterface;
use App\Droit\Arret\Entities\Arret as M;

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

        return $this->arret->where('pid','=',$pid)->with( array('arrets_categories'))->orderBy('updated_at','desc')->get();
    }

    public function getByVolume($volume_id = null,$domain_id = null){

        $arret = $this->arret->with( array('arrets_categories'));

        if($volume_id)
        {
            $arret->where('volume_id','=',$volume_id);
        }

        if($domain_id)
        {
            $arret->where('domain_id','=',$domain_id);
        }

        return $arret->orderBy('volume_id','desc')->get();
    }

    public function getByVolumeCategorie($volume_id = null,$categorie_id){

        $arret = $this->arret->with( array('arrets_categories'));

        if($volume_id){
            $arret->where('volume_id','=',$volume_id);
        }

        $arret->whereHas('arrets_categories', function($q) use ($categorie_id)
        {
            $q->where('categorie_id', '=', $categorie_id);
        });

        return $arret->orderBy('volume_id','desc')->get();
    }

    public function getByVolumePage($volume_id,$page,$search){

        $arret = $this->arret->where('volume_id','=',$volume_id)->where('page','=',$page);

        if($search['loi']){
            $arret->where('cotes','LIKE','%'.$search['loi'].'%');
        }

        if($search['article']){
            $arret->where('cotes','LIKE','%Art. '.$search['article'].'%');
        }

        return $arret->get();
    }


    public function getVolumePage($volume_id,$page){
        return $this->arret->where('volume_id','=',$volume_id)->where('page','=',$page)->get();
    }

    public function searchAgainst($terms)
    {
        return $this->arret->whereRaw(
           	 "MATCH(designation,cotes,sommaire,portee,faits,considerant,droit,conclusion) AGAINST(? IN BOOLEAN MODE)", array($terms)
	    )->get();
    }

    public function searchSimple($term)
    {
        return $this->arret
            ->where('designation', 'LIKE', '%'.$term.'%')
            ->orWhere('cotes', 'LIKE', '%'.$term.'%')
            ->orWhere('sommaire', 'LIKE', '%'.$term.'%')
            ->orWhere('portee', 'LIKE', '%'.$term.'%')
            ->orWhere('faits', 'LIKE', '%'.$term.'%')
            ->orWhere('considerant', 'LIKE', '%'.$term.'%')
            ->orWhere('droit', 'LIKE', '%'.$term.'%')
            ->orWhere('conclusion', 'LIKE', '%'.$term.'%')
            ->get();
    }

    public function find($id){

        if(is_array($id))
        {
            return $this->arret->whereIn('id', $id)->with(array('arrets_categories','arret_groupes'))->get();
        }

		return $this->arret->where('id', '=' ,$id)->with(array('arrets_categories','arret_groupes'))->get()->first();
	}

	public function create(array $data){

		$arret = $this->arret->create(array(
			'pid'         => $data['pid'],
            'designation' => $data['designation'],
            'volume_id'   => $data['volume_id'],
            'groupe'      => (isset($data['groupe']) ? $data['groupe'] : null),
            'domain_id'   => $data['domain_id'],
            'page'        => $data['page'],
            'pub_date'    => $data['pub_date'],
            'cotes'       => $data['cotes'],
            'sommaire'    => $data['sommaire'],
            'portee'      => $data['portee'],
            'faits'       => (isset($data['faits']) ? $data['faits'] : ''),
            'considerant' => (isset($data['considerant']) ? $data['considerant'] : ''),
            'droit'       => (isset($data['droit']) ? $data['droit'] : ''),
            'conclusion'  => (isset($data['conclusion']) ? $data['conclusion'] : ''),
            'note'        => (isset($data['note']) ? $data['note'] : ''),
			'created_at'  => date('Y-m-d G:i:s'),
			'updated_at'  => date('Y-m-d G:i:s')
		));

		if( ! $arret )
		{
			return false;
		}

        $categories = (isset($data['categorie_id']) && !empty($data['categorie_id']) ? $data['categorie_id'] : null);

        if($categories){
            $arret->arrets_categories()->attach($categories);
        }

        if(isset($data['groupe'])){
            $arret->arret_groupes()->attach($data['groupe_id']);
        }

        return $arret;
		
	}
	
	public function update(array $data){

        $arret = $this->arret->findOrFail($data['id']);
		
		if( ! $arret )
		{
			return false;
		}

        $arret->fill($data);

		$arret->updated_at = date('Y-m-d G:i:s');

		$arret->save();

        $categories = (isset($data['categorie_id']) && !empty($data['categorie_id']) ? $data['categorie_id'] : null);

        $arret->arrets_categories()->sync([$categories]);

        if(isset($data['groupe']))
        {
            $arret->arret_groupes()->sync([$data['groupe_id']]);
        }
        else
        {
            $arret->arret_groupes()->detach();
        }
		
		return $arret;
	}

	public function delete($id){

        $arret = $this->arret->find($id);

        return $arret->delete();

	}

}
