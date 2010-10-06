<?php
class Form_Menu extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		
		//
		$id = $this->createElement('hidden', 'id');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($id);
		
		//
		$name = $this->createElement('text', 'name');
		$name->setLabel('Name: ');
		$name->setRequired(TRUE);
		$name->setAttrib('class', 'title');
		
		//strip tags
		$name->addFilter('StripTags');
		
		$this->addElement($name);
		
		$submit = $this->addElement('submit', 'submit', array('label'=>'Submit'));
	}
}
?>