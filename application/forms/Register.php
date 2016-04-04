<?php

class Application_Form_Register extends Zend_Form
{

    public function init()
    {

         /* Form Elements & Other Definitions Here ... */
		$this->setMethod('POST');
		$this->setAttrib('class','login-form');

		$id = new Zend_Form_Element_Hidden('id');

		$username = new Zend_Form_Element_Text('username');

		$username->setAttrib('class','form-username form-control ');
        $username->setRequired();
        $username->addValidator('StringLength', false, Array(3,20));
		$username->addFilter('StringTrim');
		$username->setAttrib('placeholder','User Name...');

		$email = new Zend_Form_Element_Text('email');
		$email->setAttrib('class', 'form-email form-control');
		$email->setAttrib('placeholder','Email...');
		$email->setRequired(true);
		$email->addValidator('EmailAddress', TRUE);
		$email->addValidator('db_NoRecordExists',true,array('user','email'));
		$email->addFilter('StringTrim');

  		$password = new Zend_Form_Element_Password('password');
  		$password->setAttrib('class', 'form-password form-control');
		$password->setAttrib('placeholder','Passowrd...');
		$password->setRequired(true);
		$password->addValidator('StringLength', false, array(4,15));
		$password->addErrorMessage('Please choose a password between 4-15 characters');

		$confpassword = new Zend_Form_Element_Password('cpassword');
  		$confpassword->setAttrib('class', 'form-password form-control');
		$confpassword->setAttrib('placeholder','Confirm Passowrd...');
        $confpassword->addValidator('Identical', false,array('token' => 'password'));
        $confpassword->addErrorMessage('The passwords do not match');

		$submit=new Zend_Form_Element_Submit('Sign Up');
		$submit->setAttrib('class','btn btn-link-2 btn-block');
		
		$this->addElements(array($id,$username,$email,$password,$confpassword,$submit));
		
		
    }


    }




