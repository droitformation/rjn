<?php namespace App\Droit\User\Worker;

use App\Droit\User\Repo\UserInterface;

class AboWorker{

    protected $user;
    protected $custom;
    protected $client;
    protected $base_url;
    protected $salt;

    public $abos;
    public $account;
    public $accountsToCreate;

    public function __construct(UserInterface $user)
    {
        $this->user   = $user;
        $this->custom = new \App\Droit\Helper\Helper;
        $this->client = new \GuzzleHttp\Client();

        $environment = app()->environment();

        $this->base_url = ($environment == 'local' ? 'http://lux.local' : 'http://www.publications-droit.ch/fileadmin/lux');

        $this->salt ='whatever_you_want';
    }

    public function numeroFromFacture($facture){

        if (preg_match("/^RJN-[0-9]+-[0-9]{4}/", $facture, $matches))
        {
            $numero = explode('-',$facture);

            return $numero[1];
        }

        return false;
    }

    public function authUser($email,$password){

        $response  = $this->client->get($this->base_url.'/auth/'.$email.'/'.$password);
        $data      = $response->json();

        return (!empty($data['data']) ? $data['data'] : false);
    }

    public function userIsAbonne($numero){

        $response  = $this->client->get($this->base_url.'/abonnement/'.$numero);
        $data      = $response->json();

        return (!empty($data['data']) ? $data : false);
    }

    public function allAbos()
    {
        $response   = $this->client->get($this->base_url.'/users');
        $data       = $response->json();

        $this->abos = (!empty($data['data']) ? $data['data'] : []);

        return $this;
    }

    public function numberAllAbos(){

        $all = new \Illuminate\Support\Collection($this->abos);

        return $all->lists('numero')->all();
    }

    public function getUser($numero)
    {
        $response  = $this->client->get($this->base_url.'/user/'.$numero);
        $data      = $response->json();

        return (!empty($data['data']) && !empty($data['data'][0]) ? $data['data'][0] : []);
    }

    public function usersDontHaveAcount()
    {
        $abos     = $this->allAbos()->numberAllAbos();
        $accounts = $this->getActiveAccounts();

        $this->accountsToCreate = array_diff($abos,$accounts);
        
        return $this;
    }

    public function getActiveAccounts(){

        $accounts = $this->user->getAll();

        $active_accounts = $accounts->filter(function($account)
        {
            if ($account->numero != ''){
                return true;
            }
        });

        return $active_accounts->lists('numero')->all();
    }

    public function prepareUserInfos($numero)
    {
        $user  = $this->getUser($numero);

        $infos = (!empty($user['user']) ? $user['user'] : $user['address']);

        $userinfos['numero'] = $user['numero'];
        $userinfos['email']  = $infos['email'];
        $userinfos['name']   = $infos['first_name'].' '.$infos['last_name'];

        $this->account = $userinfos;

        return $this;;
    }

    public function createAccountAndAbo($numero){

        if(!$this->emailExistAlready($this->account['email']))
        {
            $user    = $this->user->create($this->account);
            $account = $this->user->setAccount($user,'abonne',$numero);

            return $account;
        }
    }

    public function emailExistAlready($email)
    {
        $exist = $this->user->findByEmail($email);

        return ($exist ? true : false);
    }

    public function updateAccounts()
    {
        if(!empty($this->accountsToCreate))
        {
            foreach($this->accountsToCreate as $numero)
            {
                $this->prepareUserInfos($numero)->createAccountAndAbo($numero);
            }

            return 'updated!!';
        }
    }

    public function sortUsers()
    {
        $users = [];

        if(!empty($this->abos))
        {
            foreach($this->abos as $user)
            {
                $info = (!empty($user['user']) ? $user['user'] : $user['address']);

                $new = new \App\Droit\User\Entities\User();

                $new->numero     = $user['numero'];
                $new->first_name = $info['first_name'];
                $new->last_name  = $info['last_name'];
                $new->email      = $info['email'];

                $users[] = $new;
            }
        }

        $all = new \Illuminate\Support\Collection($users);

        $alls = $all->sortBy(function($user){
            return $user->numero;
        });

        return $all;
    }

}