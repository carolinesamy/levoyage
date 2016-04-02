<?php

class Application_Form_Register extends Zend_Form
{

    public function init()
    {

         /* Form Elements & Other Definitions Here ... */
		$this->setMethod('POST');
		$this->setAttrib('class','form-horizontal col-md-3');

		$id = new Zend_Form_Element_Hidden('id');

		$username = new Zend_Form_Element_Text('username');
		$username->setLabel('user name');
		$username->setAttrib('class','form-control ');
        $username->setRequired();
        $username->addValidator('StringLength', false, Array(3,20));
		$username->addFilter('StringTrim');

		$email = new Zend_Form_Element_Text('email');
		$email->setAttrib('class', 'form-control ');
		$email->setLabel('email');
		$email->setRequired(true);
		$email->addValidator('EmailAddress', TRUE);
		$email->addValidator('db_NoRecordExists',true,array('user','email'));
		$email->addFilter('StringTrim');
  		$password = new Zend_Form_Element_Password('password');
  		$password->setAttrib('class', 'form-control ');
		$password->setLabel('password');
		$password->setRequired(true);
		$password->addValidator('StringLength', false, array(4,15));
		$password->addErrorMessage('Please choose a password between 4-15 characters');

		$confpassword = new Zend_Form_Element_Password('cpassword');
  		$confpassword->setAttrib('class', 'form-control ');
		$confpassword->setLabel('confirm password');
        $confpassword->addValidator('Identical', false,array('token' => 'password'));
        $confpassword->addErrorMessage('The passwords do not match');

		
		$submit=new Zend_Form_Element_Submit('Submit');
		$submit->setAttrib('class','btn btn-success');
		$reset=new Zend_Form_Element_Reset('Reset');
		$reset->setAttrib('class','btn btn-danger');
		
		$this->addElements(array($id,$username,$email,$password,$confpassword,$submit,$reset));
		
		
    }


    }




