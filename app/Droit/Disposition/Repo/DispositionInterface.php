<?php namespace App\Droit\Disposition\Repo;

interface DispositionInterface {

    public function getAll();
    public function find($data);
    public function findByLoi($id);
    public function search($id,$article = null);
    public function searchByArticle($article);
    public function getVolumePage($volume,$page);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);
}
