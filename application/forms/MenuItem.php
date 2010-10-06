<?php
class Form_MenuItem extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		//
		$id = $this->createElement('hidden', 'id');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($id);
		
		$menuId = $this->createElement('hidden', 'menu_id');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($menuId);
		
		$label = $this->createElement('text', 'label');
		$label->setLabel('Label: ');
		$label->setRequired(true);
		$label->addFilter('StripTags');
		$label->setAttrib('size', 40);
		$this->addElement($label);
		
		$pageId = $this->createElement('select', 'page_id');
		$pageId->setLabel('Select a page to link to: ');
		$pageId->setRequired(true);
		
		$pageModel = new Model_Page();
		$pages = $pageModel->fetchAll(null, 'name');
		$pageId->addMultiOption(0, 'None');
		if($pages->count() > 0)
		{
			foreach($pages as $page)
			{
				$pageId->addMultiOption($page->id, $page->name);
			}
		}
		$this->addElement($pageId);
		
		$link = $this->createElement("text", 'link');
		$link->setLabel('or specify a link: ');
		$link->setRequired(FALSE);
		$link->setAttrib('size',50);
		$this->addElement($link);
		
		$submit = $this->addElement('submit', 'submit', array('label'=>'Submit'));
	}
}
?>