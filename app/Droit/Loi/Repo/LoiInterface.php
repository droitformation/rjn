<?php namespace App\Droit\Loi\Repo;

interface LoiInterface {

    public function getAll();
    public function find($data);
    public function findSigle($id);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);
}
