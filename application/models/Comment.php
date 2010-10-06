<?php
class Model_Comment extends Zend_Db_Table_Abstract
{
	/**
	 * The default table name 
	 */
	protected $_name = 'comments';
	
	public function getCommentsByPage($pageId)
	{
		$sql = $this->select()->where("page_id=?", $pageId);
		$rows = $this->fetchAll($sql);
		if($rows)
		{
			return $rows;
		}
		return false;
	}
}
?>