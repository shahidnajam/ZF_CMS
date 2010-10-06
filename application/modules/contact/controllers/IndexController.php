<?php
class Contact_IndexController extends Zend_Controller_Action
{
	public function init()
	{
		$bootstrap = $this->getInvokeArg('bootstrap');
		$configArray = $bootstrap->getOptions();
		$this->config = new Zend_Config($configArray);
	}
	
	public function indexAction()
	{
		$contactForm = new Contact_Form_Contact();
		$contactForm->setAction('/contact');
		if($this->_request->isPost() && $contactForm->isValid($_POST))
		{
			//get the posted data
			$sender = $contactForm->getValue('name');
			$email = $contactForm->getValue('email');
			$subject = $contactForm->getValue('subject');
			$message = $contactForm->getValue('message');
			
			//load teh template
			$htmlMessage = $this->view->partial('templates/default.phtml', $contactForm->getValues());
			
			$mail = new Zend_Mail();
			//config SMTP
			$config = array(
				'auth'=>'login',
				'username'=>$this->config->zfcms->email->username,
				'password'=>$this->config->zfcms->email->password
			);
			$transport = new Zend_Mail_Transport_Smtp($this->config->zfcms->email->host, $config);
			
			$fileControl = $contactForm->getElement('attachment');
			if($fileControl->isUploaded())
			{
				$attachmentName = $fileControl->getFileName();
				$fileStream = file_get_contents($attachmentName);
				$attachment = $mail->createAttachment($fileStream);
				$attachment->filename = basename($attachmentName);
			}
			
			$mail->setSubject($subject)->
				setFrom($email, $sender)->
				addTo($this->config->zfcms->email->contact, "webmaster")->
				setBodyHtml($htmlMessage)->
				setBodyText($message);
			$result = $mail->send($transport);
			
			$this->view->messageProcessed = true;
			$this->view->sendError = ($result) ? false : true ;
			unlink($attachmentName);
		}
		$this->view->form = $contactForm;
		$this->view->contactEmail = $this->config->zfcms->email->contact; 
	}
}