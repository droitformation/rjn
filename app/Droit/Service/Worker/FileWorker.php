<?php namespace Droit\Service\Worker;

use Droit\Categorie\Repo\CategorieInterface;
use Droit\Content\Repo\ArretInterface;
use Droit\Newsletter\Repo\NewsletterContentInterface;

class FileWorker{

    protected $categorie;
    protected $arret;
    protected $content;

    public function __construct( CategorieInterface $categorie, ArretInterface $arret, NewsletterContentInterface $content)
    {
        $this->categorie = $categorie;
        $this->arret     = $arret;
        $this->content   = $content;
    }

	/*
	 * is the file used? in content
	 * @return array
	*/	
	public function used( $file ){

        $usedBy['category']   = (!$this->categorie->findyByImage($file)->isEmpty() ? $this->categorie->findyByImage($file)->toArray() : array() );
        $usedBy['newsletter'] = (!$this->content->findyByImage($file)->isEmpty() ? $this->content->findyByImage($file)->toArray() : array() );
        $usedBy['arret']      = (!$this->arret->findyByImage($file)->isEmpty() ? $this->arret->findyByImage($file)->toArray() : array() );

        return $usedBy;
	}
    
}