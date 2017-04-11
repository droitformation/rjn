<?php namespace App\Droit\Matiere\Repo;

use App\Droit\Matiere\Repo\MatiereInterface;
use App\Droit\Matiere\Entities\Matiere as M;

class MatiereEloquent implements MatiereInterface{

    protected $matiere;
    protected $note;

    public function __construct(M $matiere)
    {
        $this->matiere = $matiere;
    }

    public function getAll($alpha = null){

        if($alpha)
        {
            return $this->matiere->with(array('notes'=> function($query)
            {
                $query->leftJoin('arrets', function($join)
                {
                    $join->on('arrets.volume_id', '=', 'matiere_notes.volume_id')->on('arrets.page', '=', 'matiere_notes.page');
                });

                $query->leftJoin('doctrines', function($join)
                {
                    $join->on('doctrines.volume_id', '=', 'matiere_notes.volume_id')->on('doctrines.page', '=', 'matiere_notes.page');
                });

                $query->leftJoin('chroniques', function($join)
                {
                    $join->on('chroniques.volume_id', '=', 'matiere_notes.volume_id')->on('chroniques.page', '=', 'matiere_notes.page');
                })->select('arrets.id as arret_id','doctrines.id as doctrine_id','chroniques.id as chronique_id','matiere_notes.*');

            }
            ,'notes.note_pages' => function($query)
            {
                $query->leftJoin('arrets', function($join)
                {
                    $join->on('arrets.volume_id', '=', 'matiere_note_pages.volume_id')->on('arrets.page', '=', 'matiere_note_pages.page');
                });

                $query->leftJoin('doctrines', function($join)
                {
                    $join->on('doctrines.volume_id', '=', 'matiere_note_pages.volume_id')->on('doctrines.page', '=', 'matiere_note_pages.page');
                });

                $query->leftJoin('chroniques', function($join)
                {
                    $join->on('chroniques.volume_id', '=', 'matiere_note_pages.volume_id')->on('chroniques.page', '=', 'matiere_note_pages.page');
                })->select('arrets.id as arret_id','doctrines.id as doctrine_id','chroniques.id as chronique_id','matiere_note_pages.*');

            }))
            ->where('title','LIKE',$alpha.'%')
            ->orderBy('title', 'ASC')
            ->get();
        }

        return $this->matiere->with(array('notes'))->orderBy('title', 'ASC')->get();
    }

    public function find($id){

        return $this->matiere->with(array('notes'))->findOrFail($id);
    }

    public function search($terms)
    {
        return $this->matiere->where('title','LIKE','%'.$terms.'%')->orderBy('title', 'ASC')->get();
    }

    public function searchAgainst($terms)
    {
        return $this->matiere->whereHas('notes', function($q) use ($terms)
        {
            $q->whereRaw("MATCH(content) AGAINST(? IN BOOLEAN MODE)", array($terms) );

        })->orderBy('title', 'ASC')->get();
    }

    public function searchSimple($term)
    {
        return $this->matiere->with(array('notes'))->where('title', 'LIKE', '%'.$term.'%')
            ->orWhere(function($query) use ($term)
            {
                $query->whereHas('notes', function ($subquery) use ( $term ){
                    $subquery->where('content','LIKE','%'.$term.'%' );
                });

            })->orderBy('title', 'ASC')->get();
    }

    public function create(array $data){

        $matiere = $this->matiere->create(array(
            'title' => $data['title'],
        ));

        if( ! $matiere )
        {
            return false;
        }

        return $matiere;

    }

    public function update(array $data){

        $matiere = $this->matiere->findOrFail($data['id']);

        if( ! $matiere )
        {
            return false;
        }

        $matiere->title = $data['title'];

        $matiere->save();

        return $matiere;
    }

    public function delete($id){

        $matiere = $this->matiere->find($id);

        return $matiere->delete();
    }
    
}
