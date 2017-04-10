<?php namespace App\Droit\Matiere\Entities;

use Illuminate\Database\Eloquent\Model;

class Matiere_note_page extends Model {

    protected $fillable = ['note_id','volume_id','page'];
    public $timestamps  = false;
    protected $table = 'matiere_note_pages';

    public function volume()
    {
        return $this->hasOne('App\Droit\Rjn\Entities\Rjn','id','volume_id');
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
}
