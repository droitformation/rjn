<?php namespace Droit\Content\Repo;

use Droit\Content\Repo\ContentInterface;
use Droit\Content\Entities\Content as M;

class ContentEloquent implements ContentInterface{

	protected $content;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(M $content)
	{
		$this->content = $content;
	}

    public function getAll(){

        return $this->content->all();
    }

	public function find($id){
				
		return $this->content->findOrFail($id);
	}

    public function findyByPosition(array $positions){

        return $this->content->whereIn('position', $positions)->orderBy('rang','ASC')->get();
    }

	public function findyByType($type){

		return $this->content->where('type','=',$type)->orderBy('rang','ASC')->get();
	}

	public function create(array $data){

		$content = $this->content->create(array(
			'titre'      => $data['titre'],
			'contenu'    => $data['contenu'],
            'image'      => $data['image'],
			'url'        => $data['url'],
            'slug'       => $data['slug'],
			'type'       => $data['type'],
			'position'   => $data['position'],
            'rang'       => $data['rang'],
			'created_at' => date('Y-m-d G:i:s'),
			'updated_at' => date('Y-m-d G:i:s')
		));

		if( ! $content )
		{
			return false;
		}
		
		return $content;
		
	}
	
	public function update(array $data){

        $content = $this->content->findOrFail($data['id']);
		
		if( ! $content )
		{
			return false;
		}

        $content->titre    = $data['titre'];
        $content->contenu  = $data['contenu'];
        $content->url      = $data['url'];
		$content->type     = $data['type'];
		$content->position = $data['position'];
        $content->rang     = $data['rang'];
		$content->slug     = $data['slug'];

        if($data['image']){
            $content->image = $data['image'];
        }

		$content->updated_at = date('Y-m-d G:i:s');

		$content->save();
		
		return $content;
	}

	public function delete($id){

        $content = $this->content->find($id);

		return $content->delete();
		
	}

}
