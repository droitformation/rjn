<?php namespace App\Droit\Domain\Repo;

interface DomainInterface {

    public function getAll($droit = null);
    public function find($data);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);

}
