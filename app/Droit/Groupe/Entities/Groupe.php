<?php namespace App\Droit\Groupe\Entities;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model {

    /**
     * Set timestamps off
     */
    public $timestamps = false;

	protected $fillable = ['titre','domain_id','categorie_id','volume_id'];

    /*
     * Validation rules
    */
    protected static $rules = array();

    /*
     * Validation messages
    */
    protected static $messages = array();

    public function arret_groupes()
    {
        return $this->belongsToMany('App\Droit\Arret\Entities\Arret', 'arret_groupes', 'groupe_id', 'arret_id');
    }

}
