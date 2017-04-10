<?php namespace Droit\Listener;

use Laracasts\Commander\Events\EventListener;
use Droit\Event\UserWasSubscribed;

class EmailNotifier extends EventListener {

    public function whenUserWasSubscribed(UserWasSubscribed $event)
    {
        \Mail::send('emails.confirmation', array('token' => $event->subscribe->activation_token), function($message) use ($event)
        {
            $message->to($event->subscribe->email, $event->subscribe->email)->subject('Inscription!');
        });
    }

}