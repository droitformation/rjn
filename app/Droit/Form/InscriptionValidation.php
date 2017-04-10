<?php namespace Droit\Form;

use Laracasts\Validation\FormValidator;

class InscriptionValidation extends FormValidator {

    /*
     * Validation rules
    */
    protected $rules = array(
        'email' => 'required|email|unique:newsletter_users,email|emailconfirmed'
    );

    /*
     * Validation messages
    */
    protected $messages = array(
        'email.required'       => 'L\'email est requis',
        'email.email'          => 'Veuillez entrer une adresse email valide',
        'email.unique'         => 'Cet email existe déjà',
        'email.emailconfirmed' => 'Cet email est en attente de confirmation'
    );

}