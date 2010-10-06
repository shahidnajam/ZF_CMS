<?php
class Form_PageForm extends Zend_Form
{
	public function init()
	{
		$this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib('class', 'pageForm');
		//
		$id = $this->createElement('hidden', 'id');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($id);
		
		//
		$name = $this->createElement('text', 'name');
		$name->setLabel('Page Name: ');
		$name->addFilter('Alnum', array('allowWhiteSpace'=>true));
		$name->setRequired(TRUE);
		$name->setAttrib('class', 'title');
		$this->addElement($name);
		
		//
		$headline = $this->createElement('text', 'headline');
		$headline->setLabel('Headline: ');
		$headline->setRequired(TRUE);
		$headline->setAttrib('class', 'title');
		$this->addElement($headline);
	
		/*
		$image = $this->createElement('file', 'image');
		$image->setLabel("Image: ");
		$image->setRequired(FALSE);
		$image->setDestination(APPLICATION_PATH.'/../public/_uploads/images');
		$image->addValidator('Count', false, 1);
		$image->addValidator('Size', false, 1024000);
		$image->addValidator('Extension', false, 'jpg,png,gif');
		$this->addElement($image);
		*/
		
		//
		$description = $this->createElement('textarea', 'description');
		$description->setLabel('Description: ');
		$description->setRequired(TRUE);
		$description->setAttrib('class', 'title');
		$this->addElement($description);
		
		//
		$content = $this->createElement('textarea', 'pageContent');
		$content->setLabel('Content: ');
		$content->setRequired(TRUE);
		$this->addElement($content);
		
		//
		$submit = $this->addElement('submit', 'submit', array('label'=>'Submit'));
		
	}
}
?>