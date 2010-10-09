<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$this->_helper->layout->setLayout('home');
        $blogModel = new Model_Blog();
        $featuredItems = $blogModel->getRecentBlogs('3');
        $this->view->featuredItems = $featuredItems;
    }
}

