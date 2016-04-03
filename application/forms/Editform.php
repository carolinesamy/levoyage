

<?php

class Application_Form_Editform extends Zend_Form
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
		$username->addFilter('StringTrim');

		$email = new Zend_Form_Element_Text('email');
		$email->setAttrib('class', 'form-control ');
		$email->setLabel('email');
		$email->setRequired(true);
		$email->addFilter('StringTrim');
  	$password = new Zend_Form_Element_Password('password');
  	$password->setAttrib('class', 'form-control ');
		$password->setLabel('password');
		$password->setRequired(true);		
		$password->addErrorMessage('Please choose a password between 4-15 characters');
		$confpassword = new Zend_Form_Element_Password('cpassword');
  	$confpassword->setAttrib('class', 'form-control ');
		$confpassword->setLabel('confirm password');
    $confpassword->addErrorMessage('The passwords do not match');

		$submit=new Zend_Form_Element_Submit('Submit');
		$submit->setAttrib('class','btn btn-success');
		$reset=new Zend_Form_Element_Reset('Reset');
		$reset->setAttrib('class','btn btn-danger');
		
		$this->addElements(array($id,$username,$email,$password,$confpassword,$submit,$reset));
    }
    public function isValid($data)
      {
        $this->getElement('email')
        ->addValidators(array(
   				 array('Db_NoRecordExists',false,array(
               'table'     => 'user',
               'field'     => 'email',
               'exclude'   => array('field' => 'id','value' => $this->getValue('id')
               )
           ),
   				 array('EmailAddress', TRUE),
			))
       );
       $this->getElement('username')
       ->addValidator('StringLength', false, Array(3,20));
       $this->getElement('password')
         ->addValidator('StringLength', false, array(4,15));
         $this->getElement('cpassword')
         ->addValidator('Identical', false,array('token' => 'password'));
  return parent::isValid($data);
}


}

