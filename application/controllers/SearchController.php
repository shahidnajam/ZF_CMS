<?php

class SearchController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        if($this->_request->isPost())
        {
        	$keywords = $this->_request->getParam('query');
        	$query = Zend_Search_Lucene_Search_QueryParser::parse($keywords);
        	$index = Zend_Search_Lucene::open(APPLICATION_PATH.'/indexes');
        	$hits = $index->find($query);
        	$this->view->results = $hits;
        	$this->view->keywords = $keywords;
        	$this->view->searchType = "keyword";
        }
        else 
        {
        	if($this->_hasParam('tag'))
        	{
        		$tagModel = new Model_Tag();
        		$pagesArray = $tagModel->getPagesByTag($this->_request->getParam('tag'));
        		$this->getBlogPostsForView($pagesArray, 'tag');
        		
        	}
        	elseif($this->_hasParam('category'))
        	{
        		$catModel = new Model_Category();
        		$pagesArray = $catModel->getPagesByCategory($this->_request->getParam('category'));
        		$this->getBlogPostsForView($pagesArray, 'category');        		
        	}
        	else { $this->view->results = null; }
        }
    }
    
    private function getBlogPostsForView($pagesArray=array(), $searchType)
    {
    	if(!empty($pagesArray))
  		{
  			$pages = array();
  			foreach($pagesArray as $id)
  			{
  				$row = new CMS_Content_Item_Blog($id);
  				//print_r($row);
  				if($row)
  				{
  					$pg = new stdClass();
  					$pg->namespace = "blog";
  					$pg->page_id = $row->id;
  					$pg->page_name = $row->name;
  					$pg->page_headline = $row->headline;
  					$pg->page_description = $row->description;
  					
  					$pages[] = $pg;
  				}
  			}
  			$this->view->results = $pages;
  			$this->view->keywords = $this->_request->getParam($searchType);
  			$this->view->searchType = $searchType;
  		}
    }

    public function buildAction()
    {
        //create the index
        $index = Zend_Search_Lucene::create(APPLICATION_PATH.'/indexes');
        
        //add the pages to the index
        $this->_addPages($index);
        //add blog posts to the index
        $this->_addBlogs($index);
        //optimize the index
        $index->optimize();
        //pass the view data for reporting
        $this->view->indexSize = $index->numDocs();
    }
    
    private function _addPages(Zend_Search_Lucene_Interface &$index)
    {
    	$pageModel = new Model_Page();
    	$sql = $pageModel->select()->where("namespace='page'");
        $currentPages = $pageModel->fetchAll($sql);
        if($currentPages->count() > 0)
        {
        	foreach($currentPages as $p)
        	{
        		$page = new CMS_Content_Item_Page($p->id);
        		//add the documents to the index
        		$index->addDocument($this->_buildIndex($p, $page, 'pageContent'));
        	}
        }
    }
    
    private function _addBlogs(Zend_Search_Lucene_Interface &$index)
    {
    	$blogModel = new Model_Blog();
    	$sql = $blogModel->select()->where("namespace='blog'");
        $currentBlogs = $blogModel->fetchAll($sql);
        if($currentBlogs->count() > 0)
        {
        	//create a search document for each page
        	foreach($currentBlogs as $b)
        	{
        		$blog = new CMS_Content_Item_Blog($b->id);
        		//add the documents to the index
        		$index->addDocument($this->_buildIndex($b, $blog, 'blogContent'));
        	}
        }
    }

	private function _buildIndex($p, $content, $contentType)
	{
		$doc = new Zend_Search_Lucene_Document();
        		
   		//use an unindexed field for the id b/c you want the 
   		//id included in the search results, but not searchable
   		$doc->addField(Zend_Search_Lucene_Field::unIndexed('page_id', $content->id));
   		$doc->addField(Zend_Search_Lucene_Field::unIndexed('namespace', $p->namespace));
   		
   		//use text fields here b/c you want the content to be searchable and returned in results
   		$doc->addField(Zend_Search_Lucene_Field::text('page_name', $content->name));
   		$doc->addField(Zend_Search_Lucene_Field::text('page_headline', $content->headline));
   		$doc->addField(Zend_Search_Lucene_Field::text('page_description', $content->description));
   		$doc->addField(Zend_Search_Lucene_Field::text('page_content', $content->$contentType));
   		
   		return $doc;
	}
}



