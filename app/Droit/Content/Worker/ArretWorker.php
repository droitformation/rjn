<?php namespace Droit\Content\Worker;

use Droit\Content\Repo\GroupeInterface;

class ArretWorker{

    protected $custom;

    public function __construct()
    {
        $this->custom  = new \Custom;
    }

    public function getAnalyseForArret($arret){

        if(!$arret->arrets_analyses->isEmpty()){

            return $arret->arrets_analyses;
        }

        return [];
    }

}