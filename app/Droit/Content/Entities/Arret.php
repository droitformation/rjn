<?php namespace Droit\Content\Entities;

use Droit\Common\BaseModel as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Arret extends BaseModel {

    use SoftDeletingTrait;

	protected $fillable = ['pid','user_id','reference','pub_date','abstract','pub_text','file','categories'];
    protected $dates    = ['pub_date','created_at','updated_at','deleted_at'];

    /*
     * Validation rules
    */
    protected static $rules = array(
        'reference'  => 'required',
        'categories' => 'required',
        'pub_date'   => 'required',
        'abstract'   => 'required'
    );

    /*
     * Validation messages
    */
    protected static $messages = array(
        'reference.required'   => 'La référence est requise',
        'pub_date.required'    => 'La date de publication est requise',
        'abstract.required'    => 'Le résumé est requis',
        'categories.required'  => 'Au moins une catégorie est requise'
    );

    public function arrets_categories()
    {
        return $this->belongsToMany('\Droit\Categorie\Entities\Categories', 'arret_categories', 'arret_id', 'categories_id')->withPivot('sorting')->orderBy('sorting', 'asc');
    }

    public function arrets_analyses()
    {
        return $this->belongsToMany('\Droit\Content\Entities\Analyse', 'analyses_arret', 'arret_id', 'analyse_id')->withPivot('sorting')->orderBy('sorting', 'asc');
    }

}
