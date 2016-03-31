<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
     protected $_name = 'user';

     function adduser($userData)
	{
	    $row = $this->createRow();
		$row->username = $userData['username'];
		$row->email = $userData['email'];
		$row->password =$userData['password'];
		$row->save();	
	}

}

