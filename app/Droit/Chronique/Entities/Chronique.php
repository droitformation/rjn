<?php namespace App\Droit\Chronique\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chronique extends Model {

    use SoftDeletes;

	protected $fillable = ['pid','domain_id','sorting','volume_id','page','pub_date','titre','faits','commentaires','citations'];
    protected $dates    = ['pub_date','created_at','updated_at','deleted_at'];

    public function chronique_citations()
    {
        return $this->hasOne('App\Droit\Doctrine\Entities\Doctrine_citations');
    }

    public function author_chronique()
    {
        return $this->belongsToMany('App\Droit\Author\Entities\Author', 'author_chronique', 'chronique_id', 'author_id')->withPivot('role');
    }

}
