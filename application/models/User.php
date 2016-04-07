<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
     protected $_name = 'user';

    protected $_dependentTables = array('Application_Model_Bookhotel','Application_Model_RentCar');
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
	   
	      return $this->find($id);
	 }
	function updateuser($id,$userData)
	{
		$userToBeUpdated['username']=$userData['username'];
		$userToBeUpdated['email']=$userData['email'];
		$this->update($userToBeUpdated,"id=$id");

	}
	function alluser()
	{
		$user=$this->fetchAll()->toArray();
		return $user;
	}
	function unblockuser($id)
	{
		$blockuser['is_active']=1;
		$this->update($blockuser,"id=$id");

	}
	function blockuser($id)
	{
		$blockuser['is_active']=0;
		$this->update($blockuser,"id=$id");

	}
	function setadmin($id)
	{
		$setadmin['is_admin']=1;
		$this->update($setadmin,"id=$id");

	}
	function deleteuser($user_id)
	{
		$this->delete("id=$user_id");
	}

	function count()
	{
		$rows = $this->select()->from($this, 'count(*) as amt')->query()->fetchAll();
		return($rows[0]['amt']);
	}

}

