<?php
class Contact_Form_Contact extends Zend_Form 
{
	public function init()
	{
        $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
		$configArray = $bootstrap->getOptions();
		$config = new Zend_Config($configArray);
        $privateKey = $config->zfcms->recaptcha->privateKey;
        $publicKey = $config->zfcms->recaptcha->publicKey;

        
		$this->setMethod('post');
		$this->setAttrib('enctype', 'multipart/form-data');
		
		$name = $this->createElement('text', 'name')->
			setLabel("Enter your name: ")->
			setRequired(true)->
			setAttrib('class', 'title');
		$this->addElement($name);
		
		$email = $this->createElement('text', 'email')->
			setLabel('Enter your email address: ')->
			setRequired(TRUE)->
			setAttrib('class', 'title')->
			addValidator('EmailAddress')->
			addErrorMessage('Invalid Email Address!');
		$this->addElement($email);
		
		$subject = $this->createElement('text', 'subject')->
			setLabel("Subject: ")->
			setRequired(true)->
			setAttrib('class', 'title');
		$this->addElement($subject);
		
		$message = $this->createElement('textarea', 'message')->
			setLabel("Message: ")->
			setRequired(true)->
			setAttrib('class', 'title');
		$this->addElement($message);
		
		$attachment = $this->createElement('file', 'attachment')->
			setLabel("Attach a file")->
			setRequired(false)->
			setDestination(APPLICATION_PATH.'/../public/_uploads/email')->
			addValidator('Count', false, 1)->
			addValidator('Size', false, 409600);
		$this->addElement($attachment);
		
		//captcha
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