<?php

class BlogController extends Zend_Controller_Action
{

    public function init()
    {
       
    }

    public function indexAction()
    {
        $blogModel = new Model_Blog();
        $recentBlogs = $blogModel->getRecentBlogs();
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
        
        $this->view->recentBlogs = (count($recentBlogs) > 0) ? $recentBlogs : null ;
        
    }

    public function createAction()
    {
        $blogForm = new Form_BlogForm();
        $tagModel = new Model_Tag();
        if($this->getRequest()->isPost() && $blogForm->isValid($_POST))
        {
        	//create a new blog Item
        	$itemBlog = new CMS_Content_Item_Blog();
        	$itemBlog->name = $blogForm->getValue('name');
        	$itemBlog->headline = $blogForm->getValue('headline');
        	$itemBlog->category_id = $blogForm->getValue('category_id');
        	$itemBlog->description = $blogForm->getValue('description');
        	$itemBlog->blogContent = $blogForm->getValue('blogContent');
        	$itemBlog->comments = $blogForm->getValue('comments');
        	
        	//upload the image
        	if($blogForm->image->isUploaded())
        	{
        		$blogForm->image->receive();
        		$itemBlog->image = '/_uploads/images/'.basename($blogForm->image->getFileName());
        	}
        	$id = $itemBlog->save();
        	
        	//save tags
        	$tags = $blogForm->getValue('tags');
        	if(!empty($tags)){ $tagModel->saveTags($tags, $id); }
        	
        	return $this->_forward('list');
        }
        $blogForm->setAction('/blog/create');
        $this->view->form = $blogForm;
        array_push($this->view->jsFlag, 'tagCloud');
		array_push($this->view->jsFlag, 'tinymce');
    }

    public function listAction()
    {
        $blogModel = new Model_Blog();
        //fetch all blogs
        $select = $blogModel->select()->where("namespace='blog'")->order('name');
        $currentBlogs = $blogModel->fetchAll($select);
        if($currentBlogs->count() > 0)
        {
        	$this->view->blogs = $currentBlogs;
        }
        else
        {
        	$this->view->blogs = null;
        }
    }

	public function editAction()
	{
		$id = $this->_request->getParam('id');
		$itemBlog = new CMS_Content_Item_Blog($id);
		$blogForm = new Form_BlogForm();
		$blogForm->setAction('/blog/edit');
		$tagModel = new Model_Tag();
		
		if($this->_request->isPost() && $blogForm->isValid($_POST))
		{
			$itemBlog->name = $blogForm->getValue('name');
        	$itemBlog->headline = $blogForm->getValue('headline');
        	$itemBlog->description = $blogForm->getValue('description');
        	$itemBlog->category_id = $blogForm->getValue('category_id');
        	$itemBlog->blogContent = $blogForm->getValue('blogContent');
        	$itemBlog->comments = $blogForm->getValue('comments');
        	
        	//upload the image
        	if($blogForm->image->isUploaded())
        	{
        		$blogForm->image->receive();
        		$itemBlog->image = '/_uploads/images/'.basename($blogForm->image->getFileName());
        	}
        	$itemBlog->save();
        	
        	$tags = $blogForm->getValue('tags');
        	if(!empty($tags)){ $tagModel->saveTags($tags, $id); }
        	
        	return $this->_forward('list');
			
		}
		
		$blogFormData = $itemBlog->toArray();
		
		$blogFormData['tags'] = $tagModel->getTagsByPage($id);
		
		$blogForm->populate($blogFormData);
		
		//image preview
		$imagePreview = $blogForm->createElement('image', 'image_preview');
		
		//element options
		$imagePreview->setLabel('Preview Image:');
		$imagePreview->setAttrib('style', 'width:200px; height:auto;');
		
		//add to form
		$imagePreview->setOrder(4);
		$imagePreview->setImage($itemBlog->image);
		$blogForm->addElement($imagePreview);
		
		$this->view->form = $blogForm;
		array_push($this->view->jsFlag, 'tagCloud');
		array_push($this->view->jsFlag, 'tinymce');
	}
	
	public function deleteAction()
	{
		$id = $this->_request->getParam('id');
		$itemBlog = new CMS_Content_Item_Blog($id);
		$itemBlog->delete();
		
		$tagModel = new Model_Tag();
		$sql = $tagModel->select()->where("page_id=?",$id);
		$tagModel->delete("page_id='".intval($id)."'");
		return $this->_forward('list');
	}
	
	public function viewAction()
	{
		$id = $this->_request->getParam('id');
		//try to get cached version
		$bootstrap = $this->getInvokeArg('bootstrap');
		$cache = $bootstrap->getResource('cache');
		$cacheKey = "content_page_".$id;
		$blog = $cache->load($cacheKey);
		if(!$blog)//if not cached
		{
			//see if blog actually exists
			$blogModel = new Model_Blog();
			if(!$blogModel->find($id)->current())
			{
				throw new Zend_Controller_Action_Exception("The blog post you requested was not found", 404);
			}
			else 
			{
				$blog = new CMS_Content_Item_Blog($id);
				//add a cache tag to update the cached menu when you update the blog
				$tags[] = 'page_'.$blog->id;
				$cache->save($blog, $cacheKey, $tags);
			}
		}
		if($blog->comments == 1)
		{
			$commentsModel = new Model_Comment();
			$this->view->comments = $commentsModel->getCommentsByPage($id);
		}
		$this->view->blog = $blog;
		$tagModel = new Model_Tag();
		$tags = $tagModel->getTagsByPage($id, false);
		$this->view->tags = $tags;
	}
	
	
}




