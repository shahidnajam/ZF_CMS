<?php
class Form_BlogForm extends Zend_Form
{
	public function init()
	{
		$this->setAttrib('enctype', 'multipart/form-data');
		//
		$id = $this->createElement('hidden', 'id');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($id);
		
		//
		$name = $this->createElement('text', 'name');
		$name->setLabel('Page Name: ');
		$name->addFilter('Alnum', array('allowWhiteSpace'=>true));
		$name->setRequired(TRUE);
		$name->setAttrib('size', 40);
		$this->addElement($name);
		
		//
		$category = $this->createElement('select', 'category_id');
		$category->setLabel("Category: ");
		$category->addMultiOptions($this->getCategories());
		$this->addElement($category);
		
		//
		$headline = $this->createElement('text', 'headline');
		$headline->setLabel('Headline: ');
		$headline->setRequired(TRUE);
		$headline->setAttrib('size', 40);
		$this->addElement($headline);
	
		//
		$image = $this->createElement('file', 'image');
		$image->setLabel("Image: ");
		$image->setRequired(FALSE);
		$image->setDestination(APPLICATION_PATH.'/../public/_uploads/images');
		$image->addValidator('Count', false, 1);
		$image->addValidator('Size', false, 1024000);
		$image->addValidator('Extension', false, 'jpg,png,gif');
		$this->addElement($image);
		
		//
		$description = $this->createElement('textarea', 'description');
		$description->setLabel('Description: ');
		$description->setRequired(TRUE);
		$description->setAttrib('cols', 40);
		$description->setAttrib('rows', 4);
		$this->addElement($description);
		
		//
		$content = $this->createElement('textarea', 'blogContent');
		$content->setLabel('Content: ');
		$content->setRequired(TRUE);
		$content->setAttrib('cols', 40);
		$content->setAttrib('rows', 8);
		$this->addElement($content);
		
		//
		$comments = $this->createElement('checkbox', 'comments');
		$comments->setLabel("Allow Comments: ");
		$this->addElement($comments);
		
		//
		$tags = $this->createElement('textarea', 'tags');
		$tags->setLabel('Tags: ');
		$tags->setAttrib('cols', 40);
		$tags->setAttrib('rows', 4);
		$this->addElement($tags);
		
		//
		$submit = $this->addElement('submit', 'submit', array('label'=>'Submit'));
		
	}
	
	private function getCategories()
	{
		$catModel = new Model_Category();
		$cats = $catModel->getCategories();
		$optionsArray = array();
		foreach($cats as $cat)
		{
			$optionsArray[$cat->id] = $cat->category;
		}
		return $optionsArray;
	}
}
?>