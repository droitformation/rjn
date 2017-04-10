<?php namespace App\Droit\Disposition\Entities;

use Illuminate\Database\Eloquent\Model;

class Disposition_page extends Model {

    protected $fillable = ['alinea','chiffre','lettre','disposition_id','volume_id','page'];
    public $timestamps  = false;
    protected $table = 'disposition_pages';
}
