<?php
class Form_User extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		
		$id = $this->createElement('hidden', 'id');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($id);
		
		$username = $this->createElement('text', 'username');
		$username->setRequired(true);
        $username->setAttrib('class', 'title');
		$username->setLabel("Username: ");
		$username->addFilter('StripTags');
		$username->addErrorMessage("Please enter a username");
		$this->addElement($username);
		
		$password = $this->createElement('password', 'password');
		$password->setLabel('Password: ');
        $password->setAttrib('class', 'title');
		$password->setRequired(true);
		$this->addElement($password);
		
		$firstName = $this->createElement('text', 'first_name');
		$firstName->setLabel('First Name: ');
        $firstName->setAttrib('class', 'title');
		$firstName->setRequired(true);
		$firstName->addFilter('StripTags');
		$this->addElement($firstName);
		
		$lastName = $this->createElement('text', 'last_name');
		$lastName->setLabel('Last Name: ');
        $lastName->setAttrib('class', 'title');
		$lastName->setRequired(true);
		$lastName->addFilter('StripTags');
		$this->addElement($lastName);
		
		$role = $this->createElement('select', 'role');
		$role->setLabel("Select a Role: ");
        $role->setAttrib('class', 'title');
		$role->addMultiOption('User', 'user');
		$role->addMultiOption('Administrator', 'administrator');
		$this->addElement($role);

		$submit = $this->addElement('submit', 'submit', array('label'=>'Submit'));
	}
}
?>