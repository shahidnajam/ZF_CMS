<?php
/**
 * Blog
 *  
 * @author djheru
 * @version 
 */
class Model_Blog extends Zend_Db_Table_Abstract
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
	 * maps the blogs to any parent blogs
	 *
	 * @var array
	 */
	protected $_referenceMap = array(
		'Blog'=>array(
			'columns'=>array('parent_id'),
			'refTableClass'=>'Model_Blog',
			'refColumns'=>array('id'),
			'onDelete'=>self::CASCADE,
			'onUpdate'=>self::RESTRICT
		)
	);
	
	/**
	 * Create a new blog
	 *
	 * @param string $name
	 * @param string $namespace
	 * @param int $parentId
	 * @return int
	 */
	public function createBlog($name, $namespace, $parentId=0)
	{
		//create the new blog
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
	 * Updates a blog and relevant child nodes
	 *
	 * @param int $id
	 * @param array $data
	 */
	
	public function updateBlog($id, $data)
	{
		//find blog
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
			
			//unset the data blogs data, leaving only 
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
				throw new Zend_Exception('Could not open the blog to update!');
			}
		}
	}
	
	/**
	 * delete a blog
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function deleteBlog($id)
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
	 * get recent blogs
	 * 
	 * @param int $count
	 * @param string $namespace
	 */
	public function getRecentBlogs($count=10, $namespace='blog')
	{
		$select = $this->select();
		$select->order('date_created DESC');
		$select->where('namespace=?',$namespace);
		if($count > 0) { $select->limit($count); }
		$results = $this->fetchAll($select);
		if($results->count() > 0)
		{
			$blogs = array();
			foreach($results as $result)
			{
				$blogItem = new CMS_Content_Item_Blog($result->id);
				$catModel = new Model_Category();
				$cat = $catModel->getCategoryNameById($blogItem->category_id);
				$blogItem->category_id = strtolower(str_replace('/', '', str_replace(' ', '', $cat)));
				
				$blogs[$result->id] = $blogItem;
			}
			return $blogs;
		}
		return null;
	}

    public function fetchPaginatorAdapter($filter=array())
    {        
        $blogs = $this->getRecentBlogs(0);
        $adapter = new Zend_Paginator_Adapter_Array($blogs);
        return $adapter;

    }
}
