<?php

class BugController extends Zend_Controller_Action
{
	/**
	 * initialization function
	 *
	 */
    public function init()
    {
        /* Initialize action controller here */
    }

    /**
     * default action
     *
     */
    public function indexAction()
    {
        return $this->_forward('list');
    }

    /**
     * handles submission of a new bug
     *
     */
    public function submitAction()
    {
    	$bugReportForm = new Form_BugReportForm();
    	$bugReportForm->setAction('/bug/submit')
    		->setMethod('post');
    	if($this->getRequest()->isPost())
    	{
    		if($bugReportForm->isValid($_POST))
    		{
    			//convert date
    			$date = strtotime($bugReportForm->getValue('date'));
    			if($date === false) { $date = time(); }
    			//store the result of valid submission
    			$bugModel = new Model_Bug();
    			$result = $bugModel->createBug(
    				$bugReportForm->getValue('author'),
    				$bugReportForm->getValue('email'),
    				strtotime($bugReportForm->getValue('date')),
    				$bugReportForm->getValue('url'),
    				$bugReportForm->getValue('description'),
    				$bugReportForm->getValue('priority'),
    				$bugReportForm->getValue('status')
    			);
    			if($result)
    			{
    				$this->_redirect('/bug/confirm');
    			}
    		}
    	}
    	$this->view->form = $bugReportForm;
    }
	
    /**
     * Displays confirmation message after submission
     *
     */
    public function confirmAction()
    {
        // action body
    }

    /**
     * lists bugs with optional filter and sorting
     *
     */
	public function listAction()
	{
		//filter form
		$listToolsForm = new Form_BugListToolsForm();
		$listToolsForm->setAction('/bug/list');
		$listToolsForm->setMethod('post');
		$this->view->listToolsForm = $listToolsForm;
		
		//set sort and filter criteria
		$sort = $this->_request->getParam('sort', null);
		$filterField = $this->_request->getParam('filter_field', null);
		$filterValue = $this->_request->getParam('filter');		
		$filter = (!empty($filterField)) ? array($filterField=>$filterValue) : null;
		
		//manually set the form element values
		$listToolsForm->getElement('sort')->setValue($sort);
		$listToolsForm->getElement('filter_field')->setValue($filterField);
		$listToolsForm->getElement('filter')->setValue($filterValue);
		
		//get the paginator adapter
		$bugModel = new Model_Bug();
		$adapter = $bugModel->fetchPaginatorAdapter($filter, $sort);
		$paginator = new Zend_Paginator($adapter);
		
		//set 10 results per page
		//TODO:allow user to select results per page
		$paginator->setItemCountPerPage(1);
		
		//get the page number from request - default to 1
		$page = $this->_request->getParam('page',1);
		$paginator->setCurrentPageNumber($page);
		
		//pass the paginator to the view
		$this->view->paginator = $paginator;
	}
	
	public function editAction()
	{
		//create instance of model and form
		$bugModel = new Model_Bug();
		$bugReportForm = new Form_BugReportForm();
		//configure form
		$bugReportForm->setAction('/bug/edit');
		$bugReportForm->setMethod('post');
		//is this a post request
		if($this->getRequest()->isPost())
		{
			if($bugReportForm->isValid($_POST))
			{
				$result = $bugModel->updateBug(
					$bugReportForm->getValue('id'),
					$bugReportForm->getValue('author'),
					$bugReportForm->getValue('email'),
					$bugReportForm->getValue('date'),
					$bugReportForm->getValue('url'),
					$bugReportForm->getValue('description'),
					$bugReportForm->getValue('priority'),
					$bugReportForm->getValue('status')
				);
			}
			return $this->_forward('list');
		}
		else 
		{
			//if not a post, get the current data and populate form
			$id = $this->_request->getParam('id');
			$bug = $bugModel->find($id)->current();
			$bugReportForm->populate($bug->toArray());
			$bugReportForm->getElement('date')->setValue(date('m-d-Y', $bug->date));
		}
		$this->view->bug = $bug;
		$this->view->form = $bugReportForm;		
	}
	
    public function deleteAction()
    {
        //create instance of model
        $bugModel = new Model_Bug();
        $id = $this->_request->getParam('id');
        $bugModel->deleteBug($id);
        return $this->_redirect('/bug/list');
    }

}







