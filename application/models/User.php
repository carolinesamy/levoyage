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
		function userDetails($id)
         {
	   
	      return $this->find($id)->toArray();
	 }
	function updateuser($id,$userData)
	{
		$userToBeUpdated['username']=$userData['username'];
		$userToBeUpdated['email']=$userData['email'];
		$this->update($userToBeUpdated,"id=$id");
	}




}

