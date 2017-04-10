<?php namespace App\Droit\Matiere\Repo;

use App\Droit\Matiere\Repo\MatiereNoteInterface;
use App\Droit\Matiere\Entities\Matiere_note as M;

class MatiereNoteEloquent implements MatiereNoteInterface{

    protected $matiere_note;
    protected $note;

    public function __construct(M $matiere_note)
    {
        $this->matiere_note = $matiere_note;
    }

    public function getAll($alpha = null){

        return $this->matiere_note->with(array('matiere','note_pages','note_pages.volume'))->whereHas('matiere', function($q) use ($alpha){

            $q->where('title','LIKE',$alpha.'%');

        })->orderBy('content', 'ASC')->get();
    }

    public function find($id){

        return $this->matiere_note->with(array('note_pages'))->findOrFail($id);
    }

    public function findByMatiere($matiere_id){

        return $this->matiere_note->with(array('note_pages'))->where('matiere_id','=',$matiere_id)->get();
    }

    public function create(array $data){

        $matiere_note = $this->matiere_note->create(array(
            'matiere_id'     => $data['matiere_id'],
            'content'        => $data['content'],
            'page'           => $data['page'],
            'volume_id'      => $data['volume_id'],
            'domaine'        => $data['domaine'],
            'confer_externe' => $data['confer_externe'],
            'confer_interne' => $data['confer_interne']
        ));

        if( ! $matiere_note )
        {
            return false;
        }

        return $matiere_note;

    }

    public function update(array $data){

        $matiere_note = $this->matiere_note->findOrFail($data['id']);

        if( ! $matiere_note )
        {
            return false;
        }

        $matiere_note->fill($data);

        $matiere_note->save();

        return $matiere_note;
    }

    public function delete($id){

        $matiere_note = $this->matiere_note->find($id);

        return $matiere_note->delete($id);
    }

}
