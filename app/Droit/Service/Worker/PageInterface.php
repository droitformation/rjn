<?php namespace App\Droit\Service\Worker;

interface PageInterface{

    public function calcul($page, $volume);
    public function getContent($volume);
    public function findPage($page, $volume);
}

