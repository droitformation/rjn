<?php namespace App\Droit\Arret\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arret extends Model {

    use SoftDeletes;

	protected $fillable = ['pid','designation','groupe','volume_id','domain_id','page','pub_date','cotes','sommaire','portee','faits','considerant','droit','conclusion','note'];
    protected $dates    = ['pub_date','created_at','updated_at','deleted_at'];

    public function arrets_categories()
    {
        return $this->belongsToMany('App\Droit\Categorie\Entities\Categorie', 'arret_categories', 'arret_id', 'categorie_id')->withPivot('sorting')->orderBy('sorting', 'asc');
    }
    
    public function arret_groupes()
    {
        return $this->belongsToMany('App\Droit\Groupe\Entities\Groupe', 'arret_groupes', 'arret_id', 'groupe_id');
    }

}
