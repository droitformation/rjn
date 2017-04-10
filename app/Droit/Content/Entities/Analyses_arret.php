<?php namespace Droit\Content\Entities;

use Droit\Common\BaseModel as BaseModel;

class Analyses_arret extends BaseModel {

	protected $guarded   = array('id');
	public static $rules = array();
	public $timestamps   = false;
	protected $table     = 'analyses_arret';
}