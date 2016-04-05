

<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
		$this->setAttrib('class','login-form');

		
		$email = new Zend_Form_Element_Text('email');
		$email->setAttrib('class', 'form-username form-control ');
        $email->setAttrib('placeholder','Email...');
		$email->setRequired(true);
		$email->addValidator('regex', false, array('/^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i'));
		$email->addFilter('StringTrim');		
		$email->setErrorMessages(array("email not valid "));

  		$password = new Zend_Form_Element_Password('password');
  		$password->setAttrib('class', 'form-password form-control');
		$password->setAttrib('placeholder','Passowrd...');
		$password->setRequired(true);
		$password->setErrorMessages(array("wrong password"));
		

		$submit=new Zend_Form_Element_Submit('Sign in');
		$submit->setAttrib('class','btn btn-link-2 btn-block');
		$this->addElements(array($email,$password,$submit));
		
		
    }
    }



