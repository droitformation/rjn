<?php namespace Droit\Content\Repo;

interface ArretInterface {

    public function getAll($pid);
    public function getPaginate($pid,$nbr);
    public function getLatest();
	public function find($data);
    public function findyByImage($file);
	public function create(array $data);
	public function update(array $data);
	public function delete($id);

}
