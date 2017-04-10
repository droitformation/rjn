<?php namespace App\Droit\Rjn\Entities;

use Illuminate\Database\Eloquent\Model;

class Rjn extends Model {

    protected $table = 'rjn';
    protected $dates    = ['created_at','updated_at','publication_at'];

	protected $fillable = ['title','publication_at'];

    public static $rules = array(
        'title' => 'required',
        'publication_at' => 'required'
    );

    public static $messages = array(
        'title.required' => 'Le titre est requis',
        'publication_at.required' => 'L\'année est requise'
    );

    public function getVolumeAttribute()
    {
         return $this->publication_at->year;
    }

}

