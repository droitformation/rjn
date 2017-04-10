<?php namespace App\Droit\Service\Worker;

use App\Droit\Service\Worker\PageInterface;
use App\Droit\Doctrine\Repo\DoctrineInterface;
use App\Droit\Chronique\Repo\ChroniqueInterface;
use App\Droit\Arret\Repo\ArretInterface;

class PageWorker implements PageInterface{

    protected $doctrine;
    protected $arret;
    protected $chronique;
    protected $helper;

    /* Inject dependencies */
    public function __construct( DoctrineInterface $doctrine, ChroniqueInterface $chronique, ArretInterface $arret )
    {
        $this->doctrine  = $doctrine;
        $this->arret     = $arret;
        $this->chronique = $chronique;
        $this->helper    = new \App\Droit\Helper\Helper;
    }

    /**
     * Return collection arrets prepared for filtered
     *
     * @return collection
     */
    public function calcul($page, $volume)
    {
        $data = $this->findPage($page, $volume);

        return $data;
    }

    public function getContent($volume){

        $arrets     = $this->arret->getByVolume($volume);
        $doctrines  = $this->doctrine->getByVolume($volume);
        $chroniques = $this->chronique->getByVolume($volume);

        $data['arret']     = $arrets->pluck('page','id')->all();
        $data['article']   = $doctrines->pluck( 'page','id')->all();
        $data['chronique'] = $chroniques->pluck('page','id')->all();

        return $data;

    }

    public function findPage($page, $volume)
    {
        $data = $this->getContent($volume);

        foreach($data as $content => $pages)
        {
            $key = array_search($page,$pages);

            if ($key !== false)
            {
                return ['content' => $content, 'id' => $key];
            }
            else
            {
                return [];
            }
        }
    }


}