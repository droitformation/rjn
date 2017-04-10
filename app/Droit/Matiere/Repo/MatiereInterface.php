<?php namespace App\Droit\Matiere\Repo;

interface MatiereInterface {

    public function getAll($alpha = null);
    public function find($data);
    public function searchAgainst($terms);
    public function searchSimple($term);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);
}
