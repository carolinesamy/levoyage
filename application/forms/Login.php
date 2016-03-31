<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
		$this->setAttrib('class','form-horizontal col-md-3');

		
		$username = new Zend_Form_Element_Text('username');
		$username->setAttrib('class', 'form-control ');
		$username->setLabel('username');
		$username->setRequired(true);
        $username->addValidator('StringLength', false, Array(3,20));
		$username->addFilter('StringTrim');		
		$username->setErrorMessages(array("username not exist"));

  		$password = new Zend_Form_Element_Password('password');
  		$password->setAttrib('class', 'form-control ');
		$password->setLabel('password');
		$password->setRequired(true);
		$password->setErrorMessages(array("wrong password"));
		

		$submit=new Zend_Form_Element_Submit('Login');
		$submit->setAttrib('class','btn btn-info');
		$this->addElements(array($username,$password,$submit));
		
		
    }
    }



