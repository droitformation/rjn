<?php namespace App\Droit\Domain\Worker;

use App\Droit\Domain\Repo\DomainInterface;
use App\Droit\Categorie\Repo\CategorieInterface;

class DomainWorker{

    protected $domain;
    protected $categorie;

    public function __construct(DomainInterface $domain, CategorieInterface $categorie)
    {
        $this->domain    = $domain;
        $this->categorie = $categorie;
    }

    public function categorieDropdown($droit)
    {
        $domains = $this->domain->getAll($droit);

        if(!$domains->isEmpty()){
            foreach($domains as $domain){
                $categories = (isset($domain->categories) ? $domain->categories->lists('title','id')->all() : [] );

                $dropdown[$domain->id]['id']         = $domain->id;
                $dropdown[$domain->id]['title']      = $domain->title;
                $dropdown[$domain->id]['categories'] = $categories;
            }

            return $dropdown;
        }

        return [];
    }

    public function domainDropdown()
    {
        $domains = $this->domain->getAll();

        if(!$domains->isEmpty())
        {
            foreach($domains as $domain)
            {
                $dropdown[$domain->droit][$domain->id] = $domain->title;
            }

            return $dropdown;
        }

        return [];
    }

}