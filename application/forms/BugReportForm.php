<?php
class Form_BugReportForm extends Zend_Form
{
	public function init()
	{
		//store bug id
		$id = $this->createElement('hidden', 'id');
		$this->addElement($id);
		
		//add author textbox element
		$author = $this->createElement('text', 'author');
		$author->setLabel('Enter Your Name: ')
			->setRequired(TRUE)
                ->setAttrib('class', 'title')
			->setAttrib('size', 30);
		$this->addElement($author);
		
		//add email textbox element
		$email = $this->createElement('text', 'email');
		$email->setLabel('Your Email Address: ')
			->setRequired(TRUE)
			->addValidator(new Zend_Validate_EmailAddress())
			->setAttrib('class', 'title')
			->addFilters(array(
				new Zend_Filter_StringTrim(),
				new Zend_Filter_StringToLower()
			));
		$this->addElement($email);
			
		//add date textbox element
		$date = $this->createElement('text', 'date');
		$date->setLabel("Date the issue occurred (mm-dd-yyyy)")
			->setRequired(TRUE)
			->addValidator(new Zend_Validate_Date('mm-dd-yyyy'))
			->setAttrib('class', 'title');
		$this->addElement($date);
			
		//add URL textbox element
		$url = $this->createElement('text', 'url');
		$url->setLabel('Issue URL: ')
			->setRequired(TRUE)
			->setAttrib('class', 'title');
		$this->addElement($url);
		
		//add description textarea
		$description = $this->createElement('textarea','description');
		$description->setLabel('Issue Description: ')
			->setRequired(TRUE)
			->setAttrib('class', 'title');
		$this->addElement($description);
		
		//add priority select box
		$priority = $this->createElement('select', 'priority');
		$priority->setLabel('Issue Priority: ')
			->setRequired(TRUE)
			->addMultiOptions(array(
				'low'=>'Low',
				'med'=>'Medium',
				'high'=>'High'
			))
            ->setAttrib('class', 'title');
		$this->addElement($priority);
				
		//add status select box
		$status = $this->createElement('select','status');
		$status->setLabel('Current Status: ')
			->setRequired(TRUE)
			->addMultiOptions(array(
				'new'=>'New',
				'in_progress'=>'In Progress',
				'resolved'=>'Resolved'
			))
            ->setAttrib('class', 'title');;
		$this->addElement($status);
		
		//add submit button
		$this->addElement('submit', 'submit', array('label'=>'Submit'));
	}
	

}
?>