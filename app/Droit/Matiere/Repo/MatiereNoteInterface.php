<?php namespace App\Droit\Matiere\Repo;

interface MatiereNoteInterface {

    public function getAll($alpha = null);
    public function find($data);
    public function findByMatiere($matiere_id);
    public function getByVolumePage($volume_id,$page);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);
}
