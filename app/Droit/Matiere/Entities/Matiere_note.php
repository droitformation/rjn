<?php namespace App\Droit\Matiere\Entities;

use Illuminate\Database\Eloquent\Model;

class Matiere_note extends Model {

	protected $fillable = ['matiere_id','volume_id','content','page','domaine','confer_externe','confer_interne'];
    public $timestamps  = false;

    public function getAnchorAttribute($value)
    {
        $conf = $this->confer_interne;
        $conf = str_replace("cf.","",trim($conf));
        $pos  = strpos($conf, ';');

        if($pos === false)
        {
            $conf = str_replace("cf.","",$conf);
            $confer[rtrim(trim(\Str::slug($conf)))] = $conf;
        }
        else
        {
            $list = array_map('trim', explode(';', $conf));

            foreach($list as $item)
            {
                $item = str_replace("cf.","",$item);
                $confer[rtrim(trim(\Str::slug($item)))] = $item;
            }
        }

        return $confer;
    }

    public function getPageExistAttribute()
    {
        $page   = $this->page;
        $volume = $this->volume_id;

        $calculer = \App::make('App\Droit\Service\Worker\PageInterface');
        $url    = $calculer->calcul($page,$volume);

        if(!empty($url))
        {
            return true;
        }
    }

    public function getExistUrlAttribute()
    {
        if(!empty($this->arret_id))
        {
            return ['content' => 'arret', 'id' => $this->arret_id];
        }

        if(!empty($this->doctrine_id))
        {
            return ['content' => 'article', 'id' => $this->doctrine_id];
        }

        if(!empty($this->chronique_id))
        {
            return ['content' => 'chronique', 'id' => $this->chronique_id];
        }

        return null;
    }

    public function getSlugAttribute($value)
    {
        return \Str::slug($this->confer_interne);
    }

    public function matiere()
    {
        return $this->belongsTo('App\Droit\Matiere\Entities\Matiere');
    }

    public function note_pages()
    {
        return $this->hasMany('App\Droit\Matiere\Entities\Matiere_note_page', 'note_id', 'id');
    }

}


