<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
		$this->setAttrib('class','form-horizontal col-md-3');

		
		$email = new Zend_Form_Element_Text('email');
		$email->setAttrib('class', 'form-control ');
		$email->setLabel('email');
		$email->setRequired(true);
		$email->addValidator('regex', false, array('/^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i'));
		$email->addFilter('StringTrim');		
		$email->setErrorMessages(array("email not valid "));

  		$password = new Zend_Form_Element_Password('password');
  		$password->setAttrib('class', 'form-control ');
		$password->setLabel('password');
		$password->setRequired(true);
		$password->setErrorMessages(array("wrong password"));
		

		$submit=new Zend_Form_Element_Submit('Login');
		$submit->setAttrib('class','btn btn-info');
		$this->addElements(array($email,$password,$submit));
		
		
    }
    }



