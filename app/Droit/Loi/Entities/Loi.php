<?php namespace App\Droit\Loi\Entities;

use Illuminate\Database\Eloquent\Model;

class Loi extends Model {

	protected $fillable = ['name','sigle','droit'];
    public $timestamps  = false;

    public static $rules = array(
        'name' => 'required'
    );

    public static $messages = array(
        'name.required' => 'Le nom est requis'
    );

    public function dispositions()
    {
        return $this->hasMany('App\Droit\Disposition\Entities\Disposition');
    }

    public function getTitleAttribute()
    {
        $prefixes = ['Arrêté','Accord','Loi','Ordonnance'];
        return !empty($this->sigle) && !in_array($this->sigle ,$prefixes) ? $this->sigle : $this->name;
    }
}

