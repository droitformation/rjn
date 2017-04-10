<?php namespace Droit\Form;

use Laracasts\Validation\FormValidator;

class MessageValidation extends FormValidator {

    /*
     * Validation rules
    */
    protected $rules = array(
        'email'    => 'required|email',
        'nom'      => 'required',
        'remarque' => 'required'
    );

    /*
     * Validation messages
    */
    protected $messages = array(
        'email.required'   => 'L\'email est requis',
        'email.email'      => 'Veuillez entrer une adresse email valide',
        'nom.required'     => 'Le nom est requis',
        'remarque.required'=> 'Le message est requis',
    );

}