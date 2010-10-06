<?php
class Model_User extends Zend_Db_Table_Abstract
{
	protected $_name = 'users';
	
	public function createUser($username, $password, $firstName, $lastName, $role)
	{
		$row = $this->createRow();
		if($row)
		{
			$row->username = $username;
			$row->password = md5($password);
			$row->first_name = $firstName;
			$row->last_name = $lastName;
			$row->role = $role;
			
			$row->save();
			return $row;
		}
		else 
		{
			throw new Zend_Exception("Unable to create user");
		}
	}
	
	public static function getUsers()
	{
		$userModel = new self();
		$select = $userModel->select()->order(array('last_name', 'first_name'));
		return $userModel->fetchAll($select);
	}
	
	public function updateUser($id, $username, $firstName, $lastName, $role)
	{
		$row = $this->find($id)->current();
		if($row)
		{
			$row->username = $username;
			$row->first_name = $firstName;
			$row->last_name = $lastName;
			$row->role = $role;
			$row->save();
			
			return $row;
		}
		else 
		{
			throw new Zend_Exception("User update failed. User not found");
		}
	}
	
	public function updatePassword($id, $password)
	{
		$row = $this->find($id)->current();
		if($row)
		{
			$row->password = md5($password);
			$row->save();
		}
		else
		{
			throw new Zend_Exception("Unable to update password. User not found.");
		}
	}
	
	public function deleteUser($id)
	{
		$row = $this->find($id)->current();
		if($row)
		{
			$row->delete();
		}
		else
		{
			throw new Zend_Exception("Unable to delete user. That record cannot be found.");
		}
	}
}
?>