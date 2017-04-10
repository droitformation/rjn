<?php namespace Droit\Content\Entities;

use Droit\Common\BaseModel as BaseModel;

class Analyse extends BaseModel {

	protected $guarded   = array();

    /*
     * Validation rules
    */
    protected static $rules = array(
        'authors'   => 'required',
        'arrets'    => 'required',
        'pub_date'  => 'required',
    );

    /*
     * Validation messages
    */
    protected static $messages = array(
        'authors.required'  => 'L\'auteur est requis',
        'arrets.required'   => 'Au moins un arrêts est requis',
        'pub_date.required' => 'La date de publication est requise'
    );

    protected $table    = 'analyses';
    protected $fillable = ['pid','user_id','deleted','authors','pub_date','abstract','file','categories','arrets'];
    protected $dates    = ['pub_date','created_at','updated_at'];

    public function analyses_categories()
    {
        return $this->belongsToMany('\Droit\Categorie\Entities\Categories', 'analyse_categories', 'analyse_id', 'categories_id')->withPivot('sorting')->orderBy('sorting', 'asc');
    }
    
	public function analyses_arrets()
    {     
        return $this->belongsToMany('Droit\Content\Entities\Arret', 'analyses_arret', 'analyse_id', 'arret_id')->withPivot('sorting')->orderBy('sorting', 'asc');
    }

}
