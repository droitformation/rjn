<?php namespace App\Droit\User\Repo;

interface UserInterface {

    public function getAll();
    public function find($data);
    public function findByEmail($email);
    public function create(array $data);
    public function setAccount($user,$role,$numero);
    public function update(array $data);
    public function delete($id);

}
