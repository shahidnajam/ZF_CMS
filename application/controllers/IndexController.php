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
        $recentBlogs = $blogModel->getRecentBlogs('4');
        $featuredItems = array();
        if(is_array($recentBlogs))
        {
        	for($i=1; $i<=3; $i++)
        	{
        		if(count($recentBlogs) > 0)
        		{
        			$featuredItems[] = array_shift($recentBlogs);
        		}
        	}
        }
        $this->view->featuredItems = $featuredItems;
    }
}

