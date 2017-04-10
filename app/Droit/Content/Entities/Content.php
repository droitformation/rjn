<?php namespace Droit\Content\Entities;

use Droit\Common\BaseModel as BaseModel;

class Content extends BaseModel {

	protected $fillable = ['titre','contenu','image','url','slug','type','position','rang'];

	/*
     * Validation rules
    */
	protected static $rules = array();

	/*
     * Validation messages
    */
	protected static $messages = array();

}