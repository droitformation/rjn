<?php namespace App\Droit\Disposition\Entities;

use Illuminate\Database\Eloquent\Model;

class Disposition extends Model {

	protected $fillable = ['loi_id','cote','page','content','subdivision','volume_id'];
    public $timestamps  = false;

    public function getCoteNumberAttribute()
    {
        $article = trim($this->cote);
        $cote    = str_replace("Art. ", "", $article);

        return $cote;
    }

    public function getPageExistAttribute()
    {
        $page   = $this->page;
        $volume = $this->volume_id;

        $calcul = \App::make('App\Droit\Service\Worker\PageInterface');
        $url    = $calcul->calcul($page,$volume);

        if(!empty($url))
        {
            return true;
        }
    }

    public function loi()
    {
        return $this->belongsTo('App\Droit\Loi\Entities\Loi');
    }

    public function disposition_pages()
    {
        return $this->hasMany('App\Droit\Disposition\Entities\Disposition_page', 'disposition_id', 'id');
    }

}
