<?php
class Contact_Form_Contact extends Zend_Form 
{
	public function init()
	{
		$this->setMethod('post');
		$this->setAttrib('enctype', 'multipart/form-data');
		
		$name = $this->createElement('text', 'name')->
			setLabel("Enter your name: ")->
			setRequired(true)->
			setAttrib('size', 40);
		$this->addElement($name);
		
		$email = $this->createElement('text', 'email')->
			setLabel('Enter your email address: ')->
			setRequired(TRUE)->
			setAttrib('size', 40)->
			addValidator('EmailAddress')->
			addErrorMessage('Invalid Email Address!');
		$this->addElement($email);
		
		$subject = $this->createElement('text', 'subject')->
			setLabel("Subject: ")->
			setRequired(true)->
			setAttrib('size', 40);
		$this->addElement($subject);
		
		$attachment = $this->createElement('file', 'attachment')->
			setLabel("Attach a file")->
			setRequired(false)->
			setDestination(APPLICATION_PATH.'/../public/_uploads/email')->
			addValidator('Count', false, 1)->
			addValidator('Size', false, 409600);
		$this->addElement($attachment);
		
		$message = $this->createElement('textarea', 'message')->
			setLabel("Message: ")->
			setRequired(true)->
			setAttrib('cols', 40)->
			setAttrib('rows', 12);
		$this->addElement($message);
		
		//captcha
		$privateKey = '6LcaQQsAAAAAACKnQyvXEQbfcxQsjYjEoekNmXNk';
		$publicKey = '6LcaQQsAAAAAAOgbXTtRBPMKVE_uBq-uzISIT2_5';
		$options = array('theme'=>'clean');
		$reCaptcha = new Zend_Service_ReCaptcha($publicKey, $privateKey, null, $options);
		$captcha = new Zend_Form_Element_Captcha('captcha', array(
			'captcha'=>'ReCaptcha',
			'captchaOptions'=>array(
				'captcha'=>'ReCaptcha',
				'service'=>$reCaptcha
			)
		));
		$this->addElement($captcha);
		
		$submit = $this->addElement('submit', 'submit', array('label'=>'Send Message'));
	}
	
}
?>