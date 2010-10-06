<?php

class FeedController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function rssAction()
    {
        //build the feed array
        $feedArray = array();
        
        //the title and link are required'
        $feedArray['title'] = "Recent Posts";
        $feedArray['link'] = "http://".$_SERVER['HTTP_HOST']."/";
        
        //published timestamp is optional
        $feedArray['published'] = Zend_Date::now()->toString(Zend_Date::TIMESTAMP);
        
        //the charset is required
        $feedArray['charset'] = 'UTF8';
        
        $blogModel = new Model_Blog();
        $recentBlogs = $blogModel->getRecentBlogs();
        
        if(is_array($recentBlogs) && count($recentBlogs) > 0)
        {
        	foreach($recentBlogs as $blog)
        	{
        		$filter = new Zend_Filter_Alnum();
        		$uriBlogName = $filter->setAllowWhiteSpace(true)->filter($blog->name);
        		$entry = array(
        			'guid'=>$blog->id,
        			'title'=>$blog->headline,
        			'link'=>"http://".$_SERVER['HTTP_HOST']."/blog/view/id/".$blog->id."/title/".$uriBlogName,
        			'description'=>$blog->description,
        			'content'=>$blog->blogContent
        		);
        		$feedArray['entries'][] = $entry;
        	}
        }
        
        //create an RSS feed from the array
        $feed = Zend_Feed::importArray($feedArray, 'rss');
        
        //transmit the feed
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->layout->disableLayout();
        $feed->send();
    }


}



