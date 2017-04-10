<?php namespace App\Droit\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model {

	protected $fillable = ['title','droit','sorting'];
    public $timestamps  = false;

    public static $rules = array(
        'title' => 'required'
    );

    public static $messages = array(
        'title.required' => 'Le titre est requis'
    );

    public function categories()
    {
        return $this->hasMany('App\Droit\Categorie\Entities\Categorie', 'domain_id', 'id');
    }
}

