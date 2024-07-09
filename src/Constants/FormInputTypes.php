<?php

namespace Processton\ProcesstonObject\Constants;

class FormInputTypes extends DataMapper{
    protected static $typeMap = array(
        'text' => 'text',
        'string' => 'text', // Synonym for text input
        'password' => 'password',
        'textarea' => 'textarea',
        'radio' => 'radio',
        'checkbox' => 'checkbox',
        'select' => 'select',
        'file' => 'file',
        'hidden' => 'hidden',
        'submit' => 'submit',
        'reset' => 'reset',
        'number' => 'number', // Synonym for number input (HTML5)
    );
}
