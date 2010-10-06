<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity())
        {
        	$this->view->identity = $auth->getIdentity();
        }
        else
        {
        	$userForm = new Form_User();
	   		$userForm->setAction('/user/login');
	   		$userForm->removeElement('first_name');
	   		$userForm->removeElement('last_name');
	   		$userForm->removeElement('role');
	   		
	   		$userForm->addDecorator('HtmlTag', array('tag' => '<ul>'))->addDecorator('Form');
	   		
	   		$userForm->getElement('username')->setDecorators(array(
	   			array('ViewHelper'), 
	   			array('Errors'),
	   			array('Label', array('separator'=>' ')),
	   			array('HtmlTag', array('tag'=>'span'))
	   		));
	   		$userForm->getElement('password')->setDecorators(array(
	   			array('ViewHelper'), 
	   			array('Errors'),
	   			array('Label', array('separator'=>' ')),
	   			array('HtmlTag', array('tag'=>'span'))
	   		));
	   		$userForm->getElement('submit')->setDecorators(array(
            	array('ViewHelper'),
           		array('Description'),
            	array('HtmlTag', array('tag' => 'span')),
        	));
	   		
	   		
	   		$this->view->form = $userForm;
        }
    }

    public function createAction()
    {
        $userForm = new Form_User();
        if($this->_request->isPost() && $userForm->isValid($_POST))
        {
        	$userModel = new Model_User();
        	$userModel->createUser(
        		$userForm->getValue('username'),
        		$userForm->getValue('password'),
        		$userForm->getValue('first_name'),
        		$userForm->getValue('last_name'),
        		$userForm->getValue('role')
        	);
        	
        	return $this->_forward('list');
        }
        $userForm->setAction('/user/create');
        $this->view->form = $userForm;
    }

   public function listAction()
   {
   		$currentUsers = Model_User::getUsers();
   		$this->view->users = ($currentUsers->count() > 0) ? $currentUsers : null;
   }
   
   public function editAction()
   {
   		if($this->_hasParam('id'))
   		{
	   		$userForm = new Form_User();
	   		$userForm->setAction('/user/edit');
	   		$userForm->removeElement('password');
	   		$userModel = new Model_User();
	   		
	   		if($this->_request->isPost() && $userForm->isValid($_POST))
	   		{
	   			$userModel->updateUser(
	   				$userForm->getValue('id'),
	   				$userForm->getValue('username'),
	   				$userForm->getValue('first_name'),
	   				$userForm->getValue('last_name'),
	   				$userForm->getValue('role')
	   			);
	   		}
	   		else 
	   		{
		   		$id = $this->_request->getParam('id');
		   		$currentUser = $userModel->find($id)->current();
	   		}
	   		$userForm->populate($currentUser->toArray());
	   		$this->view->form = $userForm;
   		}
   }
   
   public function passwordAction()
   {
   		$passwordForm = new Form_User();
   		$passwordForm->setAction('/user/password');
   		$passwordForm->removeElement('first_name');
   		$passwordForm->removeElement('last_name');
   		$passwordForm->removeElement('username');
   		$passwordForm->removeElement('role');
   		
   		$userModel = new Model_User();
   		if($this->_request->isPost() && $passwordForm->isValid($_POST))
   		{
   			$userModel->updatePassword(
   				$passwordForm->getValue('id'),
   				$passwordForm->getValue('password')
   			);
   			
   			return $this->_forward('list');
   			
   		}
   		elseif($this->_hasParam('id'))
   		{
   			$id = $this->_request->getParam('id');
   			$currentUser = $userModel->find($id)->current();
   			$passwordForm->populate($currentUser->toArray());
   			$this->view->form = $passwordForm;
   		}
   		else
   		{
   			$this->_redirect('/user/list');
   		}
   }
   
   public function deleteAction()
   {
   		if($this->_hasParam('id'))
   		{
   			$id = $this->_request->getParam('id');
   			$userModel = new Model_User();
   			$userModel->deleteUser($id);
   		}
   		return $this->_forward('list');
   }
   
   public function loginAction()
   {
   		$userForm = new Form_User();
   		$userForm->setAction('/user/login');
   		$userForm->removeElement('first_name');
   		$userForm->removeElement('last_name');
   		$userForm->removeElement('role');
   		
   		if($this->_request->isPost() && $userForm->isValid($_POST))
   		{
   			$data = $userForm->getValues();
   			//get the default db adapter
   			$db = Zend_Db_Table::getDefaultAdapter();
   			
   			//create the auth adapter
   			$authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'username', 'password');
   			
   			//set the username and password
   			$authAdapter->setIdentity($data['username']);
   			$authAdapter->setCredential(md5($data['password']));
   			
   			//authenticate
   			$result = $authAdapter->authenticate();
   			if($result->isValid())
   			{
   				$auth = Zend_Auth::getInstance();
   				$storage = $auth->getStorage();
   				$storage->write($authAdapter->getResultRowObject(array(
   					'username',
   					'first_name',
   					'last_name',
   					'role'
   				)));
   				
   				return $this->_forward('index');
   			}
   			else
   			{
   				$this->view->loginMessage = "Sorry, your username or password is incorrect.";
   			}
   		}
   		
   		$this->view->form = $userForm;
   }
   
   public function logoutAction()
   {
   		$authAdapter = Zend_Auth::getInstance();
   		$authAdapter->clearIdentity();
   }

}



