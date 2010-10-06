<?php
/**
 * Category
 *  
 * @author djheru
 * @version 
 */
class Model_Category extends Zend_Db_Table_Abstract
{
	/**
	 * The default table name 
	 */
	protected $_name = 'categories';
	
	public function getCategories()
	{
		$rows = $this->fetchAll();
		return ($rows) ? $rows : array();
	}
	
	public function getPagesByCategory($category)
	{
		$sql = $this->select()->where('category=?', $category);
		$row = $this->fetchRow($sql);
		if($row)
		{
			$nodeModel = new Model_ContentNode();
			$select = $nodeModel->select()->where('node="category_id"')->where('content=?', $row->id);
			$rows = $nodeModel->fetchAll($select);
			if($rows)
			{
				$pageIds = array();
				foreach($rows as $row)
				{
					$pageIds[] = $row->page_id;
				}
				
				return $pageIds;
			}
		}
		return false;
	}
	
	public function getCategoryNameById($id)
	{
		$row = $this->find(intval($id))->current();
		return ($row) ? $row->category : '';
	}
}
