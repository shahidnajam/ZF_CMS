<?php
/**
 * Page
 *  
 * @author djheru
 * @version 
 */
class Model_Page extends Zend_Db_Table_Abstract
{
	/**
	 * The default table name 
	 */
	protected $_name = 'pages';
	
	/**
	 * designate child table
	 *
	 * @var array
	 */
	protected $_dependentTables = array('Model_ContentNode');
	
	/**
	 * maps the pages to any parent pages
	 *
	 * @var array
	 */
	protected $_referenceMap = array(
		'Page'=>array(
			'columns'=>array('parent_id'),
			'refTableClass'=>'Model_Page',
			'refColumns'=>array('id'),
			'onDelete'=>self::CASCADE,
			'onUpdate'=>self::RESTRICT
		)
	);
	
	/**
	 * Create a new page
	 *
	 * @param string $name
	 * @param string $namespace
	 * @param int $parentId
	 * @return int
	 */
	public function createPage($name, $namespace, $parentId=0)
	{
		//create the new page
		$row = $this->createRow();
		$row->name = $name;
		$row->namespace = $namespace;
		$row->parent_id = $parentId;
		$row->date_created = time();
		$row->save();
		//now return the autoincrement id
		return $this->_db->lastInsertId();
	}
	
	/**
	 * Updates a page and relevant child nodes
	 *
	 * @param int $id
	 * @param array $data
	 */
	
	public function updatePage($id, $data)
	{
		//find page
		$row = $this->find($id)->current();
		if($row)
		{
			//clear any cached records that are tagged to this page
			$cache = Zend_Registry::get('cache');
			$tag = "page_".$id;
			$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array($tag));
			
			//update the columns
			$row->name = $data['name'];
			$row->parent_id = $data['parent_id'];
			$row->save();
			
			//unset the data pages data, leaving only 
			//the data for the content_nodes table
			unset($data['id']);
			unset($data['name']);
			unset($data['parent_id']);
			
			//now loop thru the rest of the data 
			//and set it on the content_nodes table
			if(count($data) > 0)
			{
				$contentNodeModel = new Model_ContentNode();
				foreach($data as $k=>$v)
				{
					$contentNodeModel->setNode($id, $k, $v);
				}
			}
			else
			{
				throw new Zend_Exception('Could not open the page to update!');
			}
		}
	}
	
	/**
	 * delete a page
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function deletePage($id)
	{
		//find row
		$row = $this->find($id)->current();
		if($row)
		{
			//clear any cached records that are tagged to this page
			$cache = Zend_Registry::get('cache');
			$tag = "page_".$id;
			$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array($tag));
			
			$row->delete();
			return true;
		}
		
	}
	
	/**
	 * get recent pages
	 * 
	 * @param int $count
	 * @param string $namespace
	 */
	public function getRecentPages($count=10, $namespace='page')
	{
		$select = $this->select();
		$select->order('date_created DESC');
		$select->where('namespace=?',$namespace);
		$select->limit($count);
		$results = $this->fetchAll($select);
		if($results->count() > 0)
		{
			$pages = array();
			foreach($results as $result)
			{
				$pages[$result->id] = new CMS_Content_Item_Page($result->id);
			}
			return $pages;
		}
		return null;
	}
}
