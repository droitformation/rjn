<?php namespace App\Droit\Critique\Repo;

interface CritiqueInterface {

    public function getAll();
    public function find($data);
    public function getByType($type, $id = null);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);

}
