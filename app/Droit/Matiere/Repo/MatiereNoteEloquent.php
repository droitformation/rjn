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
            'domaine'        => isset($data['domaine']) && !empty($data['domaine']) ? $data['domaine'] : null,
            'confer_externe' => isset($data['confer_externe']) && !empty($data['confer_externe']) ? $data['confer_externe'] : null,
            'confer_interne' => isset($data['confer_interne']) && !empty($data['confer_interne']) ? $data['confer_interne'] : null,
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


    public function getByVolumePage($volume_id,$page)
    {
        return $this->matiere_note->where('volume_id','=',$volume_id)
            ->where('page','=',$page)
            ->get();
    }

}
