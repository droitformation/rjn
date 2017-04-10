<?php namespace App\Droit\Arret\Repo;

interface ArretInterface {

    public function getAll($pid);
    public function getByVolume($volume_id = null,$categorie = null);
    public function getByVolumeCategorie($volume_id = null,$categorie_id);
    public function getByVolumePage($volume_id,$page,$search);
    public function searchAgainst($terms);
    public function searchSimple($term);
	public function find($data);
	public function create(array $data);
	public function update(array $data);
	public function delete($id);

}
