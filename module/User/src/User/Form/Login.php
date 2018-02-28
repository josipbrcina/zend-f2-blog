<?php

namespace User\Form;

use Zend\Form\Element;

class Login extends \Zend\Form\Form
{
    public function __construct()
    {
        parent::__construct('login');

        $email = new Element\Text('email');
        $email->setLabel('E-mail address');
        $email->setAttributes(array(
            'class' => 'form-control',
        ));

        $password = new Element\Password('password');
        $password->setLabel('Password');
        $password->setAttributes(array(
            'class' => 'form-control',
        ));

        $submit = new Element\Submit('submit');
        $submit->setValue('Login');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($email);
        $this->add($password);
        $this->add($submit);
    }
}
