<?php namespace App\Droit\Code\Repo;

interface CodeInterface {

    public function getAll();
	public function find($data);
	public function valid($code);
    public function active($user_id);
	public function create(array $data);
	public function update(array $data);
	public function delete($id);

}
