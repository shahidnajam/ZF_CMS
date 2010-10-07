<?php
class Form_Comment extends Zend_Form
{
	public function init()
	{
		$bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
		$configArray = $bootstrap->getOptions();
		$config = new Zend_Config($configArray);
        $privateKey = $config->zfcms->recaptcha->privateKey;
        $publicKey = $config->zfcms->recaptcha->publicKey;
		
		$this->setMethod('post');
		$this->setAttrib('class', 'ajax-form');
		
		//
		$id = $this->createElement('hidden', 'id');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($id);		
		//
		$name = $this->createElement('text', 'name');
		$name->setLabel('Name: ');
		$name->setRequired(TRUE);
		$name->setAttrib('class', 'commentForm');
		$name->addFilter('StripTags');		
		$this->addElement($name);
		//
		$email = $this->createElement('text', 'email');
		$email->setLabel('Email: ');
		$email->setRequired(TRUE);
		$email->setAttrib('class', 'commentForm');
		$email->addFilter('StripTags');		
		$this->addElement($email);
		//
		$content = $this->createElement('textarea', 'content');
		$content->setLabel('Comment: ');
		$content->setRequired(TRUE);
        $content->setAttrib('class', 'commentForm');
		$this->addElement($content);
		//
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
		$submit = $this->addElement('submit', 'submit', array('label'=>'Submit'));
	}
}
?>