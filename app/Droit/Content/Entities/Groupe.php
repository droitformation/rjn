<?php namespace Droit\Content\Entities;

use Droit\Common\BaseModel as BaseModel;

class Groupe extends BaseModel {

    /**
     * Set timestamps off
     */
    public $timestamps = false;

	protected $fillable = ['categorie_id'];

    /*
     * Validation rules
    */
    protected static $rules = array();

    /*
     * Validation messages
    */
    protected static $messages = array();

    public function arrets_groupes()
    {
        return $this->belongsToMany('Droit\Content\Entities\Arret', 'arrets_groupes', 'groupe_id', 'arret_id')->withPivot('sorting')->orderBy('sorting', 'asc');
    }

}
