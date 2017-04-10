<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use App\Droit\Domain\Repo\DomainInterface;
use App\Droit\Categorie\Repo\CategorieInterface;
use App\Droit\Rjn\Repo\RjnInterface;
use App\Droit\Loi\Repo\LoiInterface;

class AdminComposer
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
        $droit = [ 1 => 'Droit fédéral',  2 => 'Droit cantonal', 3 => 'Droit international'];

        $view->with('droit', $droit);
    }
}