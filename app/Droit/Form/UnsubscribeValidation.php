<?php namespace Droit\Form;

use Laracasts\Validation\FormValidator;

class UnsubscribeValidation extends FormValidator {

    /*
     * Validation rules
    */
    protected $rules = array(
        'email' => 'required|email|exists:newsletter_users,email'
    );

    /*
     * Validation messages
    */
    protected $messages = array(
        'email.required'       => 'L\'email est requis',
        'email.email'          => 'Veuillez entrer une adresse email valide',
        'email.exists'         => 'Cet email n\'existe pas dans la base de données'
    );

}