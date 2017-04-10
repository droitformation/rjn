<?php namespace App\Droit\User\Repo;

use App\Droit\User\Repo\UserInterface;
use App\Droit\User\Entities\User as M;

class UserEloquent implements UserInterface{

    protected $user;

    public function __construct(M $user)
    {
        $this->user = $user;
    }

    public function getAll(){

        return $this->user->all();
    }

    public function find($id){

        return $this->user->findOrFail($id);
    }

    public function findByEmail($email){

        return $this->user->whereEmail($email)->first();
    }

    public function create(array $data){

        $user = $this->user->create(array(
            'name'           => $data['name'],
            'email'          => $data['email'],
            'role'           => (isset($data['role']) ? $data['role'] : ''),
            'numero'         => (!empty($data['numero']) ? $data['numero'] : null),
            'password'       => (isset($data['password']) ? bcrypt($data['password']) : ''),
            'created_at'     => date('Y-m-d G:i:s'),
            'updated_at'     => date('Y-m-d G:i:s')
        ));

        if( ! $user )
        {
            return false;
        }

        return $user;

    }

    public function setAccount($user,$role,$numero){

        $user->numero = $numero;
        $user->role   = $role;

        $user->save();

        return $user;
    }

    public function update(array $data){

        $user = $this->user->findOrFail($data['id']);

        if( ! $user )
        {
            return false;
        }

        $user->name       = $data['name'];
        $user->email      = $data['email'];
        $user->role       = $data['role'];
        $user->numero     = (!empty($data['numero']) ? $data['numero'] : null);

        if(!empty($data['password']))
        {
            $user->password   = bcrypt($data['password']);
        }

        $user->updated_at = date('Y-m-d G:i:s');

        $user->save();

        return $user;
    }

    public function delete($id){

        $user = $this->user->find($id);

        return $user->delete($id);
    }

}
