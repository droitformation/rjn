<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use App\Droit\Domain\Repo\DomainInterface;
use App\Droit\Categorie\Repo\CategorieInterface;
use App\Droit\Rjn\Repo\RjnInterface;
use App\Droit\Loi\Repo\LoiInterface;
use App\Droit\Matiere\Repo\MatiereInterface;

class AdminComposer
{
    protected $domain;
    protected $categorie;
    protected $rjn;
    protected $loi;
    protected $helper;
    protected $alpha;
    protected $matiere;

    public function __construct(DomainInterface $domain, CategorieInterface $categorie, RjnInterface $rjn, LoiInterface $loi, MatiereInterface $matiere)
    {
        $this->categorie = $categorie;
        $this->domain    = $domain;
        $this->rjn       = $rjn;
        $this->loi       = $loi;
        $this->matiere   = $matiere;

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

        $volumes = $this->rjn->getAll();
        $volumes = $volumes->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'year' => $item->volume
            ];
        });

        $matieres = $this->matiere->getAll();
        $matieres = $matieres->map(function ($matiere, $key) {
            return [
                'value' => $matiere->id,
                'label' => $matiere->title,
            ];
        });

        $lois = $this->loi->getAll();
        $lois = $lois->map(function ($loi, $key) {
            return [
                'value' => $loi->id,
                'label' => $loi->title,
            ];
        });
     
        $view->with('list_matieres', $matieres);
        $view->with('list_volumes', $volumes);
        $view->with('list_lois', $lois);
        $view->with('droit', $droit);
    }
}