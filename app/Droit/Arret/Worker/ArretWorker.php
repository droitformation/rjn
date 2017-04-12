<?php namespace App\Droit\Arret\Worker;


class ArretWorker{

    protected $custom;

    public function __construct()
    {
        $this->custom  = new \App\Droit\Helper\Helper;
    }

    public function dispachCategories($arrets)
    {
        if(!$arrets->isEmpty()){
            foreach($arrets as $arret){
                if(isset($arret->arrets_categories))
                {
                    foreach($arret->arrets_categories as $categorie){
                        $sort[$categorie->id][] = $arret;
                    }
                }
            }
        }

        return (!empty($sort) ? $sort : []);
    }
}