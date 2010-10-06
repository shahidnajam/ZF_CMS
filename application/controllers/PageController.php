<?php

class PageController extends Zend_Controller_Action
{

    public function init()
    {
       
    }

    public function indexAction()
    {
        $pageModel = new Model_Page();
        $recentPages = $pageModel->getRecentPages();
        if(is_array($recentPages))
        {
        	for($i=1; $i<=3; $i++)
        	{
        		if(count($recentPages) > 0)
        		{
        			$featuredItems[] = array_shift($recentPages);
        		}
        	}
        }
        $this->view->featuredItems = $featuredItems;
        
        $this->view->recentPages = (count($recentPages) > 0) ? $recentPages : null ;
        
    }

    public function createAction()
    {
        $pageForm = new Form_PageForm();
        if($this->getRequest()->isPost() && $pageForm->isValid($_POST))
        {
        	//create a new page Item
        	$itemPage = new CMS_Content_Item_Page();
        	$itemPage->name = $pageForm->getValue('name');
        	$itemPage->headline = $pageForm->getValue('headline');
        	$itemPage->description = $pageForm->getValue('description');
        	$itemPage->pageContent = $pageForm->getValue('pageContent');
        	
        	$itemPage->save();
        	return $this->_forward('list');
        }
        $pageForm->setAction('/page/create');
        $this->view->form = $pageForm;
        $this->view->jsFlag = array('tinymce');
    }

    public function listAction()
    {
        $pageModel = new Model_Page();
        //fetch all pages
        $select = $pageModel->select()->where("namespace='page'")->order('name');
        $currentPages = $pageModel->fetchAll($select);
        if($currentPages->count() > 0)
        {
        	$this->view->pages = $currentPages;
        }
        else
        {
        	$this->view->pages = null;
        }
    }

	public function editAction()
	{
		$id = $this->_request->getParam('id');
		$itemPage = new CMS_Content_Item_Page($id);
		$pageForm = new Form_PageForm();
		$pageForm->setAction('/page/edit');
		
		if($this->_request->isPost() && $pageForm->isValid($_POST))
		{
			$itemPage->name = $pageForm->getValue('name');
        	$itemPage->headline = $pageForm->getValue('headline');
        	$itemPage->description = $pageForm->getValue('description');
        	$itemPage->pageContent = $pageForm->getValue('pageContent');
        	
        	$itemPage->save();
        	return $this->_forward('list');
			
		}
		
		$pageForm->populate($itemPage->toArray());
		
		
		$this->view->form = $pageForm;
		array_push($this->view->jsFlag,'tinymce');
	}
	
	public function deleteAction()
	{
		$id = $this->_request->getParam('id');
		$itemPage = new CMS_Content_Item_Page($id);
		$itemPage->delete();
		return $this->_forward('list');
	}
	
	public function viewAction()
	{
		$id = $this->_request->getParam('id');
		//try to get cached version
		$bootstrap = $this->getInvokeArg('bootstrap');
		$cache = $bootstrap->getResource('cache');
		$cacheKey = "content_page_".$id;
		$page = $cache->load($cacheKey);
		if(!$page)//if not cached
		{
			//see if page actually exists
			$pageModel = new Model_Page();
			if(!$pageModel->find($id)->current())
			{
				throw new Zend_Controller_Action_Exception("The page you requested was not found", 404);
			}
			else 
			{
				$page = new CMS_Content_Item_Page($id);
				//add a cache tag to update the cached menu when you update the page
				$tags[] = 'page_'.$page->id;
				$cache->save($page, $cacheKey, $tags);
			}
		}
		$this->view->page = $page;
	}
	
}





