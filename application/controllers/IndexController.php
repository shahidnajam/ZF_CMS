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
        
        $this->_getHomepageContent('homeContent');
        $this->_getHomepageContent('welcomeContent');
    }    
    
    private function _getHomepageContent($area='welcomeContent')
    {
    	$pageModel = new Model_Page();
    	$homeContent = $pageModel->getHomepageContent($area);
    	if($homeContent)
    	{
	    	$content = array(
	    		'id'=>$homeContent->id,
	    		'headline'=>$homeContent->headline,
	    		'pageContent'=>$this->_prepareForHomepage($area, $homeContent->pageContent)
	    	);
	    	$this->view->$area = $content;
    	}
    }
    
    private function _prepareForHomepage($area, $html)
    {	
    	$length = strlen($html);
    	$numPTags = substr_count($html, "</p>");
    	$maxLength = ($area == 'welcomeContent') ? 600 : 1480;
    	//Substitute <p> tags with a value equal to a row of characters
    	$addLength = ($area == 'welcomeContent') ? ((50 * $numPTags) - 7) : ((68 * $numPTags) - 7);
    	if(($length + $addLength) > $maxLength)
    	{
    		$endAfterSpace = strpos($html, ' ', ($maxLength-$addLength));
    		$html = substr($html, 0, $endAfterSpace).'...';
    	}
    	return $html;
    }
}

