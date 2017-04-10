<?php namespace App\Droit\Critique\Entities;

use Illuminate\Database\Eloquent\Model;

class Critique extends Model {

    protected $fillable = ['type','item_id','author_id','titre','contenu'];
    public $timestamps  = false;

    public function arret()
    {
        return $this->belongsTo('App\Droit\Arret\Entities\Arret','item_id');
    }

    public function article()
    {
        return $this->belongsTo('App\Droit\Doctrine\Entities\Doctrine','item_id');
    }

    public function chronique()
    {
        return $this->belongsTo('App\Droit\Chronique\Entities\Chronique','item_id');
    }

    public function author()
    {
        return $this->belongsTo('App\Droit\Author\Entities\Author', 'author_id');
    }
}
