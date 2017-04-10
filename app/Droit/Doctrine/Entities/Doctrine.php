<?php namespace App\Droit\Doctrine\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctrine extends Model {

    use SoftDeletes;

	protected $fillable = ['pid','volume_id','domain_id','page','titre','article','pub_date','bibliographie','notes','citations'];
    protected $dates    = ['pub_date','created_at','updated_at','deleted_at'];

    public function doctrine_citations()
    {
        return $this->hasOne('App\Droit\Doctrine\Entities\Doctrine_citations');
    }

    public function doctrine_author()
    {
        return $this->belongsToMany('App\Droit\Author\Entities\Author', 'author_doctrine', 'doctrine_id', 'author_id');
    }

}
