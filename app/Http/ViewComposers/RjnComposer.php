<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use App\Droit\Domain\Repo\DomainInterface;
use App\Droit\Categorie\Repo\CategorieInterface;
use App\Droit\Rjn\Repo\RjnInterface;
use App\Droit\Loi\Repo\LoiInterface;

class RjnComposer
{
    protected $domain;
    protected $categorie;
    protected $rjn;
    protected $loi;
    protected $helper;
    protected $alpha;

    public function __construct(DomainInterface $domain, CategorieInterface $categorie, RjnInterface $rjn, LoiInterface $loi)
    {
        $this->categorie = $categorie;
        $this->domain    = $domain;
        $this->rjn       = $rjn;
        $this->loi       = $loi;
        $this->helper  = new \App\Droit\Helper\Helper;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $domains    = $this->domain->getAll(2);
        $categories = $this->categorie->getAll(1);

        $this->domains_doc = $this->domain->getAll(1)->pluck('title','id')->all();
        $this->volumes     = $this->rjn->getAll();

        $lois = $this->loi->getAll();

        $view->with('list_lois', $lois->pluck('sigle','id')->all());

        $lois = $this->helper->dispatchLoi($lois);

        $view->with('domains_jurisprudence', $domains->pluck('title','id')->all());
        $view->with('domains_doctrine', $this->domains_doc);
        $view->with('all_domains',     $domains);
        $view->with('all_categories',  $categories->pluck('title','id')->all());

        $view->with('rjn', $this->rjn->getAll());
        $view->with('volumes', $this->rjn->getAll());
        $view->with('search_lois',$lois);

        $alpha = ['A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z'];
        $droit = [ 1 => 'Droit fédéral',  2 => 'Droit cantonal', 3 => 'Droit international'];

        $view->with('alpha', $alpha);
        $view->with('droit', $droit);

    }
}