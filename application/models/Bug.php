<?php
class Model_Bug extends Zend_Db_Table_Abstract
{
	/**
	 * db table name
	 *
	 * @var string
	 */
	protected $_name = 'bugs';
	
	/**
	 * create a new record
	 *
	 * @param string $author
	 * @param string $email
	 * @param int $date
	 * @param string $url
	 * @param string $description
	 * @param string $priority
	 * @param string $status
	 * @return int
	 */
	public function createBug($author, $email, $date, $url, $description, $priority, $status)
	{
		//create new row
		$row = $this->createRow();
		
		//set the row data
		$row->author = $author;
		$row->email = $email;
		$row->date = $date;
		$row->url = $url;
		$row->description = $description;
		$row->priority = $priority;
		$row->status = $status;
		
		//save the row
		$row->save();
		
		//return the ID
		return $this->_db->lastInsertId();
	}
	
	
	public function fetchPaginatorAdapter($filters=array(), $sortField=null)
	{
		$select = $this->select();
		//add any filters that are set
		if(count($filters) > 0)
		{
			foreach($filters as $field=>$filter)
			{
				$filter = $this->getAdapter()->quote('%'.$filter.'%');
				$select->where($field.' LIKE '.$filter);
			}
		}
		//add the sort field if set
		if(null != $sortField)
		{
			$select->order($sortField);
		}
		//crate a new instance of the paginator adapter and return
		return new Zend_Paginator_Adapter_DbTableSelect($select);
	}
	
	public function updateBug($id, $author, $email, $date, $url, $description, $priority, $status)
	{
		//find the row that matches the id
		$row = $this->find($id)->current();
		
		if($row)
		{
			//set the new row data
			$row->author = $author;
			$row->email = $email;
			$row->date = $date;
			$row->url = $url;
			$row->description = $description;
			$row->priority = $priority;
			$row->status = $status;
			
			//save it
			$row->save();
			return true;
		}
		else
		{
			throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
	
	public function deleteBug($id)
	{
		$row = $this->find($id)->current();
		if($row)
		{
			$row->delete();
			return true;
		}
		else 
		{
			throw new Zend_Exception("Delete function failed; could not find row!");
		}
	}
}
?>