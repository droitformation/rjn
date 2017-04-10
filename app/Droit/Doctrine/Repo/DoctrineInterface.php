<?php namespace App\Droit\Doctrine\Repo;

interface DoctrineInterface {

    public function getAll($pid);
    public function getByVolume($volume_id);
    public function searchAgainst($terms);
    public function searchSimple($term);
	public function find($data);
	public function create(array $data);
	public function update(array $data);
	public function delete($id);

}
