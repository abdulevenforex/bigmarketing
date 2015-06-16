<?php

 namespace User\Form;

 use Zend\Form\Form;

 class LoginForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('login');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'email',
             'type' => 'email',
           'attributes' => array(
                'size' => '30',
                'required'=>'true',
            ),
             'options' => array(
                 'label' => 'Email',
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
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Login',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }
 ?>