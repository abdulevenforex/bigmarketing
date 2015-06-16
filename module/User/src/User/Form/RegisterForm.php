<?php

 namespace User\Form;

 use Zend\Form\Form;

 class RegisterForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('register');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'username',
             'type' => 'Text',
           'attributes' => array(
                'size' => '30',
                'required'=>'true',
            ),
             'options' => array(
                 'label' => 'Username',
             ),
         ));
         $this->add(array(
             'name' => 'password',
             'type' => 'password',
             'attributes' => array(
                'size' => '30',
                'required'=>'true',
            ),
             'options' => array(

                 'label' => 'Password',
             ),
         ));
          $this->add(array(
             'name' => 'email',
             'type' => 'email',
             'options' => array(
                 'label' => 'Email',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }
 ?>