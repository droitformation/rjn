<?php namespace App\Droit\Groupe\Repo;

interface GroupeInterface {

    public function getAll();
	public function find($data);
	public function create(array $data);
	public function update(array $data);
	public function delete($id);

}
