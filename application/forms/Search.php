<?php
class Form_Search extends Zend_Form
{
	public function init()
	{
		$query = $this->createElement('text', 'query')->
			setLabel("Keywords: ")->
			setRequired(true)->
			setAttrib('size', 20)->
			setDecorators(array(
	   			array('ViewHelper'), 
	   			array('Errors'),
	   			array('Label', array('separator'=>' ')),
	   			array('HtmlTag', array('tag'=>'span'))
	   		));
		$this->addElement($query);
		
		$submit = $this->createElement('submit', 'search')->
			setLabel('Search Site')->
			setDecorators(array(
            	array('ViewHelper'),
           		array('Description'),
            	array('HtmlTag', array('tag' => 'span')),
        	));
		$this->addElement($submit);
	}
}
?>