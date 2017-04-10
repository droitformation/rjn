<?php namespace App\Services;

use App\Droit\User\Worker\AboWorker;
use App\Droit\User\Repo\UserInterface;
use Validator;

class Hub{

    protected $user;
    protected $custom;
    protected $salt;
    protected $abo;

    public function __construct(UserInterface $user,AboWorker $abo)
    {
        $this->user   = $user;
        $this->custom = new \App\Droit\Helper\Helper;
        $this->salt   = 'whatever_you_want';
        $this->abo    = $abo;
    }

    public function auth($email,$password)
    {
        return $this->abo->authUser($email,$this->simple_encrypt(md5($password)));
    }

    function simple_encrypt($text)
    {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    function simple_decrypt($text)
    {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
}