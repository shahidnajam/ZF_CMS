<?php
/**
 * ContentNode
 *  
 * @author djheru
 * @version 
 */
require_once APPLICATION_PATH.'/models/Page.php';
class Model_ContentNode extends Zend_Db_Table_Abstract
{
	/**
	 * The default table name 
	 */
	protected $_name = 'content_nodes';
	
	/**
	 * maps this table class to the Page class
	 *
	 * @var array
	 */
	protected $_referenceMap = array(
		'Page'=>array(
			'columns'=>array('page_id'),
			'refTableClass'=>'Model_Page',
			'refColumns'=>array('id'),
			'onDelete'=>self::CASCADE,
			'onUpdate'=>self::RESTRICT
		)
	);
	
	/**
	 * Creates or updates a node
	 *
	 * @param int $pageId
	 * @param string $node
	 * @param string $value
	 */
	public function setNode($pageId, $node, $value)
	{
		//fetch row if exists
		$select = $this->select();
		$select->where("page_id=?", $pageId)->
			where("node=?", $node);
		$row = $this->fetchRow($select);
		
		//if it doesn't exist, create it
		if(!$row)
		{
			$row = $this->createRow();
			$row->page_id = $pageId;
			$row->node = $node;
		}
		
		//set the node contents
		$row->content = $value;
		$row->save();
	}
}
