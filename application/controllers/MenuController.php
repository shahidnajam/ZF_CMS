<?php

class MenuController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $menuModel = new Model_Menu();
        $this->view->menus = $menuModel->getMenus();
    }

    public function createAction()
    {
        $menuForm = new Form_Menu();
        
        
        
        if($this->getRequest()->isPost() && $menuForm->isValid($_POST))
        
        {
        
        	$menuName = $menuForm->getValue('name');
        	$menuModel = new Model_Menu();
        	$res = $menuModel->createMenu($menuName);
        
        	if($res)
        	{
        		$this->_redirect('/menu/index');
        	}
        }
        
        $menuForm->setAction('/menu/create');
        $this->view->form = $menuForm;
    }

    public function editAction()
    {
        $id = $this->_request->getParam('id');
        $menuModel = new Model_Menu();
       	$menuForm = new Form_Menu();
       	
       	if($this->getRequest()->isPost() && $menuForm->isValid($_POST))
       	{
       		$menuName = $menuForm->getValue('name');
       		$res = $menuModel->updateMenu($id, $menuName);
       		if($res)
       		{
       			return $this->_redirect('/menu/index');
       		}
       		else 
       		{
       			echo "FOO";
       		}
       	}
       	else 
       	{
	       	$currentMenu = $menuModel->find($id)->current();
	       	
	       	//
	       	$menuForm->getElement('id')->setValue($currentMenu->id);
	       	$menuForm->getElement('name')->setValue($currentMenu->name);
       	}
       	$menuForm->setAction('/menu/edit');
       	//
       	$this->view->form = $menuForm;
    }

	public function deleteAction()
	{
		$id = $this->getRequest()->getParam('id');
		$menuModel = new Model_Menu();
		$menuModel->deleteMenu($id);
		$this->_forward('index');
	}
	

	public function renderAction()
	{
		if($this->_hasParam('menuId'))
		{
			$menuId = $this->getRequest()->getParam('menuId');
			
			//fetch the Zend_Cache object
			$bootstrap = $this->getInvokeArg('bootstrap');
			$cache = $bootstrap->getResource('cache');
			$cacheKey = 'menu_'.$menuId;
			//attempt to load the menu from cache if it is not the main menu
			$container = $cache->load($cacheKey);
			if(!$container || $menuId == 1)
			{
				//if the menu is not cached, build and cache it
				$menuItemModel = new Model_MenuItem();
				$menuItems = $menuItemModel->getItemsByMenu($menuId);
				if(count($menuItems) > 0)
				{
					foreach($menuItems as $item)
					{
						//add a cache tag so you can update the menu when you update the ietms
						$tags[] = 'menu_item'.$item->id;
						$label = $item->label;
						if(!empty($item->link))
						{
							$uri = $item->link;
						}
						else 
						{	
							//add a cache tag to this menu so you can update the cached menu
							//when you update the page
							$tags[] = "page_".$item->page_id;
							$page = new CMS_Content_Item_Page($item->page_id);
							$uri = '/page/view/id/'.$item->page_id.'/title/'.$page->name;
						}
						$menuItem = array('label'=>$label, 'uri'=>$uri, 'class'=>'');
						
						$uri = $this->getRequest()->getRequestUri();
                        $uri = ($uri == '/') ? '/index/index' : $uri;
						$uriParts = array_values(array_filter(explode('/', $uri)));
						$linkParts = array_values(array_filter(explode('/', $item->link)));
						
						if($linkParts[0] == $uriParts[0])
						{
							$menuItem['class'] = 'selected';
						}
						$itemArray[] = $menuItem;
					}
					$container = new Zend_Navigation($itemArray);
					//cache the container
					$cache->save($container, $cacheKey, $tags);
				}
				
			}
			if($container instanceof Zend_Navigation_Container)
			{
				$this->view->navigation()->setContainer($container);
			}
		}
	}
}





