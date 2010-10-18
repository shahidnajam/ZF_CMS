<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload()
	{
		//Add autoloader empty namespace
		$autoLoader = Zend_Loader_Autoloader::getInstance();
		$autoLoader->registerNamespace('CMS_');
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
			'basePath'=>APPLICATION_PATH,
			'namespace'=>'',
			'resourceTypes'=>array(
				'form'=>array(
					'path'=>'forms/',
					'namespace'=>'Form_'
				),
				'model'=>array(
					'path'=>'models/',
					'namespace'=>'Model_'
				)
			)
		));
		
		//Return it so that it can be stored by the bootstrap
		return $autoLoader;
	}
	
	protected function _initView()
	{
		//initialize view
		$view = new Zend_View();
		$view->jsFlag = array(); 
		$view->doctype('HTML5');
		$view->headTitle('ZFCMS');
		$view->headScript()->appendFile('/_js/jquery.js', 'text/javascript');
		$view->headScript()->appendFile('/_js/jquery-ui.js', 'text/javascript');
		$view->headScript()->appendFile('/_js/jquery.form.js', 'text/javascript');
		$view->headScript()->appendFile('/_js/application.js', 'text/javascript');
		$view->skin = 'silver';
		
		//add it to the viewrenderer
		$viewrenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
		$viewrenderer->setView($view);
		return $view;
	}

	protected function _initMenus()
	{
		$view = $this->getResource('view');
		$view->mainMenuId = 1;
		$view->adminMenuId = 2;
	}
}

