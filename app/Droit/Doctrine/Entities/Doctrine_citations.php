<?php namespace App\Droit\Doctrine\Entities;

use Illuminate\Database\Eloquent\Model;

class Doctrine_citations extends Model {

	protected $fillable = ['doctrine_id','chronique_id','content'];
    public $timestamps  = false;
    /*
     * Validation rules
    */
    protected static $rules = array(
        'content'      => 'required',
        'doctrine_id'  => 'required_without:chronique_id',
        'chronique_id' => 'required_without:doctrine_id'
    );

    /*
     * Validation messages
    */
    protected static $messages = array(
        'content.required'              => 'Le contenu est requis',
        'doctrine_id.required_without'  => 'Un article est requis',
        'chronique_id.required_without' => 'Une chronique est requise'
    );

}
