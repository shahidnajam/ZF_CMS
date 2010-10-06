<?php

class MenuitemController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        if($this->_hasParam('menuId'))
        {
        	$menuId = $this->getRequest()->getParam('menuId');
	        $menuModel = new Model_Menu();
	        $menuItemModel = new Model_MenuItem();
	        $this->view->menu = $menuModel->find($menuId)->current();
	        $this->view->items = $menuItemModel->getItemsByMenu($menuId);
        }
        
    }

	public function addAction()
	{
		if($this->_hasParam('menuId'))
        {
        	$menuId = $this->getRequest()->getParam('menuId');
        	$menuModel = new Model_Menu();
        	$this->view->menu = $menuModel->find($menuId)->current();
        	$menuItemForm = new Form_MenuItem();
        	if($this->_request->isPost() && $menuItemForm->isValid($_POST))
        	{
        		$data = $menuItemForm->getValues();
        		$menuItemModel = new Model_MenuItem();
        		$menuItemModel->addItem($data['menu_id'], $data['label'], $data['page_id'], $data['link']);
        		$this->_request->setParam('menuId', $data['menu_id']);
        		$this->_forward('index');
        	}
        	$menuItemForm->populate(array('menu_id'=>$menuId));
        	$this->view->form = $menuItemForm;
        } 
	}
	
	public function moveAction()
	{
		if($this->_hasParam('id') && $this->_hasParam('direction'))
		{
			$id = $this->getRequest()->getParam('id');
			$direction = $this->getRequest()->getParam('direction');
			$menuItemModel = new Model_MenuItem();
			$menuItem = $menuItemModel->find($id)->current();
			if($direction == 'up')
			{
				$menuItemModel->moveUp($id);
			}
			else 
			{
				$menuItemModel->moveDown($id);
			}
			$this->getRequest()->setParam('menuId', $menuItem->menu_id);
			$this->_forward('index');
		}
	}
	
	public function editAction()
	{
		if($this->_hasParam('id'))
		{
			$id = $this->getRequest()->getParam('id');
			$menuItemModel = new Model_MenuItem();
			$currentMenuItem = $menuItemModel->find($id)->current();
			
			$menuModel = new Model_Menu();
			$this->view->menu = $menuModel->find($currentMenuItem->menu_id)->current();
			
			$menuItemForm = new Form_MenuItem();
			$menuItemForm->setAction('/menuitem/edit');
			if($this->getRequest()->isPost() && $menuItemForm->isValid($_POST))
			{
				$data = $menuItemForm->getValues();
				$menuItemModel->updateItem($data['id'], $data['label'], $data['page_id'], $data['link']);
				$this->_request->setParam('menuId', $data['menu_id']);
				return $this->_forward('index');
			}
			else 
			{
				$menuItemForm->populate($currentMenuItem->toArray());
			}
			$this->view->form = $menuItemForm;
		}
	}
	
	public function deleteAction()
	{
		if($this->_hasParam('id'))
		{
			$id = $this->getRequest()->getParam('id');
			$menuItemModel = new Model_MenuItem();
			$row = $menuItemModel->find($id)->current();
			$menuItemModel->deleteItem($id);
			$this->_request->setParam('menuId', $row->menu_id);
			$this->_forward('index');
		}
	}
	
}

