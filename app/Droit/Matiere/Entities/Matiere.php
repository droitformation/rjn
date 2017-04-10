<?php namespace App\Droit\Matiere\Entities;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model {

	protected $fillable = ['title'];
    public $timestamps  = false;

    public function notes()
    {
        return $this->hasMany('App\Droit\Matiere\Entities\Matiere_note');
    }

    public function getSlugAttribute($value)
    {
        return \Str::slug($this->title);
    }

    public function pages()
    {
        return $this->hasManyThrough('App\Droit\Matiere\Entities\Matiere_note_page', 'App\Droit\Matiere\Entities\Matiere_note', 'matiere_id', 'id');
    }
}

