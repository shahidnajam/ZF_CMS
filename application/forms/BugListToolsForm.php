<?php
class Form_BugListToolsForm extends Zend_Form
{
	public function init()
	{
		$options = array(
			'0'=>'None',
			'priority'=>'Priority',
			'status'=>'Status', 
			'date'=>'Date',
			'url'=>'URL',
			'author'=>'Submitter',
			'description'=>'Description'
		);
		
		$sort = $this->createElement('select', 'sort');
		$sort->setLabel("Sort Records By: ");
		$sort->addMultiOptions($options);
		$this->addElement($sort);
		
		$filterField = $this->createElement('select', 'filter_field');
		$filterField->setLabel("Filter By: ");
		$filterField->addMultiOptions($options);
		$this->addElement($filterField);
		
		$filter = $this->createElement('text', 'filter');
		$filter->setLabel('Search For:');
		$filter->setAttrib('size', '40');
		$this->addElement($filter);
		
		$this->addElement('submit', 'submit', array('label'=>'Update List'));
	}
}
?>