<?php namespace Droit\Event;

use Droit\Newsletter\Entities\Newsletter_users;

class UserWasSubscribed {

    public $subscribe;

    public function __construct(Newsletter_users $subscribe) /* or pass in just the relevant fields */
    {
        $this->subscribe = $subscribe;
    }

}