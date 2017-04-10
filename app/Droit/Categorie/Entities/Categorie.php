<?php namespace App\Droit\Categorie\Entities;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {

	protected $fillable = ['pid','domain_id','deleted','title','image'];
    protected $dates    = ['created_at','updated_at'];
}

